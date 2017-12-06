<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Log;
use Session;
use Illuminate\Support\Facades\DB;

//Tablas 
use App\CuotasInmuebles;
use App\GastosMov;
use App\PeriodosCerrados;
use App\ViewPeriodosCerrados;
use App\Sesiones;
use App\UltimosPeriodosCerrados;
use App\Inmuebles;
use App\ViewSaldosCuotasInmuebles;





function getSaldoAnt($idCondominio,$idInmueble,$fecha_inicio){


    $monto = ViewSaldosCuotasInmuebles:: where ('id_condominio', $idCondominio)
                                      -> where ('id_inmueble',$idInmueble)
                                      -> where ('fecha_inicio' ,'<',$fecha_inicio)
                                      -> select (DB::RAW ('IFNULL(sum(monto),0) as monto'))
                                      -> first();


    
    
        return $monto->monto;
    

}





class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function resumenperiodo(){

        $array = getIdCondominio();
        $id_condominio = $array[0];
        $tipomenu = $array[1];


        if ($id_condominio > 0 ){
            return view ('reportes.agrupado',compact('tipomenu'));
        }
    }


    public function cobranzas(){

        $array = getIdCondominio();
        $id_condominio = $array[0];
        $tipomenu = $array[1];
        
        

        if ($id_condominio > 0 ){

            $periodos = ViewPeriodosCerrados:: where ('id_condominio',$id_condominio)
                                               -> orderBy('fecha_inicio','desc') 
                                               -> take(6)
                                               -> get();
            $periodos = $periodos->reverse();  

            return view ('reportes.cobranzas',compact('periodos','tipomenu')); 
        }

    }

    public function inmuebleCobranza(){

        $array = getIdCondominio();
        $id_condominio = $array[0];
        $tipomenu = $array[1];

        if ($id_condominio > 0 ){

            $periodos = PeriodosCerrados:: where ('id_condominio',$id_condominio)
                                               -> orderBy('fecha_inicio','desc') 
                                               -> take(6)
                                               -> get();


            $periodos = $periodos->reverse();  

            if (count($periodos)> 0 ){
                $fecha_inicial_primer_periodo = $periodos[0]['fecha_inicio'] ;
            }
            



            $array = [];

            

            $inmuebles = Inmuebles:: where ('id_condominio',$id_condominio)
                                  -> get();

             $total_condo = floatval(getSaldoPeriodo($id_condominio,0,0));

             //return response()->json($total_condo);
            

            foreach ($inmuebles as $inmueble ) {

                $array2 = [];
                $total  = 0;

                
                array_push($array2,$inmueble->identificador . ' - '. $inmueble->ocupante);

                $saldo_ant = getSaldoAnt($id_condominio,$inmueble->id,$fecha_inicial_primer_periodo);
                $total += $saldo_ant; 
                if (floatval($saldo_ant) == 0 ){
                    array_push($array2,'-');
                }else {
                    array_push($array2,$saldo_ant);    
                }

                
                if (count($periodos) < 6){
                    for ($i=0; $i < 6 -count($periodos) ; $i++) { 
                        array_push($array2,'-');
                        
                    }

                }


                foreach ($periodos as $periodo) {
                    
                    $saldo = getSaldoPeriodo($id_condominio,$periodo->id_periodo,$inmueble->id);
                    if (floatval($saldo) == 0  ){
                        array_push($array2,'-');
                    }else {
                        array_push($array2,$saldo);    
                    }
                    $total += floatval($saldo);
                              
                }    


                

                array_push($array2,$total);
               
                
                

                array_push($array2,porcentaje($total,$total_condo));
                array_push($array, $array2);

            }
            

            return response()->json($array);      

        }

    }

    public function getNombreCondominio(){

        return response()->json(nombreCondominio());

    }




    public function getPeriodosNombreCondo(){

        $array = getIdCondominio();
        $id_condominio = $array[0];
        $tipomenu = $array[1];

        $response = [];

       
            

        if ($id_condominio > 0){
            $periodos = ViewPeriodosCerrados:: select (DB::raw("id_periodo as id, periodo"))
                                        -> where('id_condominio',$id_condominio)
                                        -> orderBy ('fecha_inicio','desc')
                                        -> get();  

            array_push ($response,array ('periodos' => $periodos));

            array_push ($response,array ('nombre_condominio' => nombreCondominio()));

            $periodos = ViewPeriodosCerrados:: select (DB::raw("periodo,id_periodo as id"))
                                        -> where('id_condominio',$id_condominio)
                                        -> orderBy ('fecha_inicio','desc')
                                        -> take(3)
                                        -> get();  
            $periodos = $periodos->reverse();

            $array = [];
            $array2 = [];
            $array3 = [];
            $array4 = [];

            foreach ($periodos as $periodo) {
                array_push($array, $periodo->periodo);
                array_push($array2, resumenMontoDevengado($id_condominio,$periodo->id)->monto);
                array_push($array3, resumenGastosCondominio($id_condominio,$periodo->id)->monto);
                array_push($array4, resumenCobrosCondominio($id_condominio,$periodo->id)->monto + resumenCobrosExtraCondominio($id_condominio,$periodo->id) ->monto);
            }

            array_push ($response, array('grafico1' => $array));
            array_push ($response, array('grafico2' => $array2));
            array_push ($response, array('grafico3' => $array3));
            array_push ($response, array('grafico4' => $array4));




            $saldoscobranza = ViewPeriodosCerrados:: leftJoin('cuotas_inmuebles as b',function ($join) {
                                                                $join-> on ('b.id_condominio','=','periodos_cerrados_w.id_condominio')
                                                                     -> on ('periodos_cerrados_w.fecha_inicio','<=','b.fecha_doc')
                                                                     -> on ('periodos_cerrados_w.fecha_final','>=','b.fecha_doc'); })
                                                  -> leftJoin('saldos_iniciales_w as c',function ($join) {
                                                                $join-> on ('c.id_condominio','=','periodos_cerrados_w.id_condominio')
                                                                     -> on ('periodos_cerrados_w.fecha_inicio','<=','c.fecha_final')
                                                                     -> on ('periodos_cerrados_w.fecha_final','>=','c.fecha_final'); })
                                                  -> select(DB::RAW ('periodos_cerrados_w.periodo,ifnull(sum(b.monto),0)+ifnull(sum(c.saldo_inicial),0) as monto,periodos_cerrados_w.fecha_final'))
                                                  -> where ('periodos_cerrados_w.id_condominio',$id_condominio)
                                                  -> groupBy ('periodos_cerrados_w.periodo','periodos_cerrados_w.fecha_final') 
                                                  -> orderBy ('periodos_cerrados_w.fecha_final','desc')
                                                  -> take(9)
                                                  -> get();


            $saldoscobranza = $saldoscobranza ->reverse();

            $periodos = [];
            $saldos =[];
            $saldo = 0;

            foreach ($saldoscobranza as $saldocobranza) {
                $saldo += $saldocobranza -> monto;
                array_push ($periodos,$saldocobranza -> periodo);
                array_push ($saldos,$saldo);
            }

            array_push ($response, array('grafico5' => $periodos));
            array_push ($response, array('grafico6' => $saldos));
            //return response()->json([$array,$array2,$array3,$array4]);

            return response()->json($response);
        }


    }
  

    public function getResumenCondominio($idPeriodo){

        $array = getIdCondominio();
        $id_condominio = $array[0];
        $tipomenu = $array[1];

        $response = [];

        if ($id_condominio > 0 ){

            


            $gastos = resumenGastosCondominio($id_condominio,$idPeriodo);
            $cobros = resumenCobrosCondominio($id_condominio,$idPeriodo);
            $cobros_extra = resumenCobrosExtraCondominio($id_condominio,$idPeriodo);

            $resultado = ['titulo'=> 'Resultado' , 'monto' => ($cobros->monto + $cobros_extra->monto) - $gastos->monto];

            return response()->json ([$gastos,$cobros,$cobros_extra,$resultado]);

            
        }


        
        

    }

   

    public function getPeriodosCerrados(){

        $array = getIdCondominio();
        $id_condominio = $array[0];
        $tipomenu = $array[1];

        if ($id_condominio > 0){
            $periodos = ViewPeriodosCerrados:: select (DB::raw("id_periodo as id, periodo"))
                                        -> where('id_condominio',$id_condominio)
                                        -> orderBy ('fecha_inicio','desc')
                                        -> get();  

            return response()->json($periodos);
        }

    }

    public function getUltimosPeriodosCerrados(){

        $array = getIdCondominio();
        $id_condominio = $array[0];
        $tipomenu = $array[1];

        if ($id_condominio > 0){
            $periodos = ViewPeriodosCerrados:: select (DB::raw("periodo,id_periodo as id"))
                                        -> where('id_condominio',$id_condominio)
                                        -> orderBy ('fecha_inicio','desc')
                                        -> take(3)
                                        -> get();  
            $periodos = $periodos->reverse();

            $array = [];
            $array2 = [];
            $array3 = [];
            $array4 = [];

            foreach ($periodos as $periodo) {
                array_push($array, $periodo->periodo);
                array_push($array2, resumenMontoDevengado($id_condominio,$periodo->id)->monto);
                array_push($array3, resumenGastosCondominio($id_condominio,$periodo->id)->monto);
                array_push($array4, resumenCobrosCondominio($id_condominio,$periodo->id)->monto);
            }

            return response()->json([$array,$array2,$array3,$array4]);
        }



    }

    




    public function index()
    {
        //
    }


}
