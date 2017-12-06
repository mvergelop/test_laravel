<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//Librerias 
use Response;
use Auth;
use DB;
use Session;

//Tablas 
use App\TipoGastos;
use App\Gastos;
use App\ViewGastosMov;
use App\Sesiones;
use App\User;
use App\IngresosAdicionalesMov;
use App\IngresosAdicionales;
use App\PeriodosCerrados;
use App\Condominios;


function pushTitulo($titulo) {

    $array = [];

    array_push($array,$titulo);
    array_push($array, "");
    array_push($array, "");


    return $array;
}






class RpIngresosEgresosCtlr extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (user3Validator()) {
            $array = getIdCondominio();
            $id_condominio = $array[0];
            $tipomenu = $array[1];

            if ($id_condominio > 0 ){
                return view('reportes.ingresosegresos',compact('tipomenu'));
            }

        }else { return view ('layouts.403');}

            

        
        
        

        

    }

    public function emailingresosyegresos($idCondominio,$idPeriodo){

        $count = PeriodosCerrados:: where ('id_condominio',$idCondominio)
                                 -> where ('id_periodo',$idPeriodo)
                                 -> count();

        if (Auth::check()){
            if (Auth::user()->tipo == '1'){
                $tipomenu = '1';
            }else { $tipomenu = '2';}
        }else {
            $tipomenu = '3';
        }


        if ($idCondominio > 0 && $count > 0 ) {

            if (createSesion('',$idCondominio)){
                
                return view('reportes.ingresosegresos',compact('tipomenu','idCondominio','idPeriodo'));
            }
        }else {return view ('layouts.403');}

    }




    public function getIngresosEgresos($periodo){

        $array = getIdCondominio();
        $id_condominio = $array[0];
        $tipomenu = $array[1];


        if ($id_condominio > 0 ) {

            $usuarios = User:: where ('id_condominio',$id_condominio)
                            -> first();

            $array = [];
            $output = [];

            $fechasPeriodo = PeriodosCerrados:: where ('id_periodo',$periodo)
                                              -> where ('id_condominio',$id_condominio) 
                                              -> select ('fecha_inicio','fecha_final') 
                                              -> first();

           

            //$periodo = 2;
            //$id_condominio = Auth::user()->id_condominio;

           

            array_push($output,pushTitulo('<div class="ingegre-titulo">INGRESOS DEL PERIODO</div>'));

            $IngCuotasOrdinarias = resumenCobrosCondominio($id_condominio,$periodo)->monto;
            $IngCuotasExtra      = resumenCobrosExtraCondominio($id_condominio,$periodo)->monto;

            $TotIngresosAdicionales = IngresosAdicionalesMov:: where ('id_condominio',$id_condominio)
                                                            -> where ('fecha_proceso','>=',removeDash($fechasPeriodo->fecha_inicio))
                                                            -> where ('fecha_proceso','<=',removeDash($fechasPeriodo->fecha_final))
                                                            -> select (DB::RAW ('SUM(monto) as monto'))
                                                            -> first()->monto;

            $totalingresos = ($IngCuotasOrdinarias + $IngCuotasExtra + $TotIngresosAdicionales);



            

            //Cuotas Ordinarias 
            $array = [];
            array_push($array,'<div class="ingegre-detalle1">Ingresos por Cuotas Ordinarias</div>');
            array_push($array,formatNumber($IngCuotasOrdinarias));
            array_push($array,dividir($IngCuotasOrdinarias,$totalingresos)*100);
            array_push($output,$array);

            //Cuotas Extraordinarias 
            $array = [];
            array_push($array,'<div class="ingegre-detalle1">Ingresos por Cuotas Extraordinarias</div>');
            array_push($array,formatNumber($IngCuotasExtra));
            array_push($array,dividir($IngCuotasExtra,$totalingresos)*100);
            array_push($output,$array);

            //Ingresos Adicionales
            array_push($output,pushTitulo("<div class='ingegre-titulo2'>Ingreso Adicionales</div>"));
            $ingresosadicionales = IngresosAdicionales:: where ('id_condominio',$id_condominio)
                                                      -> orderBy ('descripcion')                                                   
                                                      -> get();
            foreach ($ingresosadicionales as $ingresoadicional) {


                if ($ingresoadicional->id == 3) {
                    $monto = IngresosAdicionalesMov:: where ('id_condominio',$id_condominio)
                                               -> where ('id_ingreso',$ingresoadicional->id)
                                               -> where ('fecha_proceso','>=',removeDash($fechasPeriodo->fecha_inicio))
                                               -> where ('fecha_proceso','<=',removeDash($fechasPeriodo->fecha_final))
                                               -> select (DB::RAW ('SUM(monto) as monto'))
                                               -> first()->monto;

                } else {
                    $monto = IngresosAdicionalesMov:: where ('id_condominio',$id_condominio)
                                               -> where ('id_ingreso',$ingresoadicional->id)
                                               -> where ('fecha_proceso','>=',removeDash($fechasPeriodo->fecha_inicio))
                                               -> where ('fecha_proceso','<=',removeDash($fechasPeriodo->fecha_final))
                                               -> select (DB::RAW ('SUM(monto) as monto'))
                                               -> first()->monto;

                }
                

                $array = [];
                array_push($array,'<div class="ingegre-detalle2">'.$ingresoadicional->descripcion.'</div>');
                array_push($array,formatNumber($monto));
                array_push($array,dividir($monto,$totalingresos)*100);
                array_push($output,$array);

                  
              }  


            //TotalIngresosMes 
            $array = [];
            array_push($array,'<div class="ingegre-total">TOTAL INGRESOS PERIODO</div>');
            array_push($array,formatNumber($totalingresos));
            array_push($array,100);
            array_push($output,$array);

            //LineaBlanco
            array_push($output,pushTitulo(""));

            //Egresos 
            array_push($output,pushTitulo('<div class="ingegre-titulo">EGRESOS DEL PERIODO</div>'));
            

            $totalgastos = resumenGastosCondominio($id_condominio,$periodo)->monto;


            for ($i = 0;$i<=1;$i++) {

                $totalgastoextraordi = 0;

                if ($i == 0){
                    array_push($output,pushTitulo("<div class='ingegre-titulo2'>Gastos Ordinarios</div>"));
                }else {
                    array_push($output,pushTitulo("<div class='ingegre-titulo2'>Gastos Extraordinarios</div>"));
                }



                $tipoGastos = TipoGastos:: select ('descripcion','id')
                                    -> where ('activo','1')
                                    -> where ('tipo',$i)
                                    -> orderBy('descripcion')
                                    -> get();

           


                foreach ($tipoGastos as $tipoGasto) {


                    array_push($output,pushTitulo('<div class="ingegre-titulo3">'.$tipoGasto->descripcion.'</div>'));


                    $totaltipogasto = 0;

                    $gastos = Gastos:: select ('descripcion','id')
                                    -> where  ('id_condominio',$id_condominio)
                                    -> where  ('id_tipogasto',$tipoGasto->id)
                                    -> where (function ($query) use ($id_condominio,$periodo) {
                                                    $query-> where  ('activo','1')
                                                          -> OrwhereRaw('id IN(SELECT id_gasto FROM gastos_mov_w
                                                                               where id_condominio = '.$id_condominio.' 
                                                                               AND id_periodo ='.$periodo.')');
                                                })
                                    -> orderBy ('descripcion')
                                    -> get();



                    foreach ($gastos as $gasto ) {

                        $array = [];
                        array_push($array,'<div class="ingegre-detalle3">'.$gasto->descripcion.'</div>');
                        $monto = totalGastoPeriodo($gasto->id,$periodo,$id_condominio);
                        array_push($array,formatNumber($monto));
                        array_push($array,dividir($monto,$totalgastos)*100);
                        array_push($output,$array);
                        $totaltipogasto += $monto;
                        $totalgastoextraordi += $monto;
                    }

                    //TotalTipoGasto 
                    $array = [];
                    array_push($array,'<div class="ingegre-total">Total '. $tipoGasto->descripcion.'</div>');
                    array_push($array,formatNumber($totaltipogasto));
                    array_push($array,dividir($totaltipogasto,$totalgastos)*100);
                    array_push($output,$array);
                    
                }

                //LineaBlanco
                array_push($output,pushTitulo(""));

                //Total Gasto Ordinario o ExtraOrdinario
                $array = [];
                if ($i == 0){
                    array_push($array,'<div class="ingegre-total">Total Gastos Ordinarios</div>');
                }else {
                    array_push($array,'<div class="ingegre-total">Total Gastos Extraordinarios</div>');
                }
                array_push($array,formatNumber($totalgastoextraordi));
                array_push($array,dividir($totalgastoextraordi,$totalgastos)*100);
                array_push($output,$array);


            }

            $array = [];
            array_push($array,'<div class="ingegre-total">TOTAL EGRESOS PERIODO</div>');
            array_push($array,formatNumber($totalgastos));
            array_push($array,dividir($totalgastos,$totalgastos)*100);
            array_push($output,$array);

            //LineaBlanco
            array_push($output,pushTitulo(""));

            $array = [];
            array_push($array,'<div class="ingegre-total">RESULTADO PERIODO</div>');
            array_push($array,formatNumber(($IngCuotasOrdinarias + $IngCuotasExtra) - $totalgastos));
            array_push($array,'');
            array_push($output,$array);

            //LineaBlanco
            array_push($output,pushTitulo(""));

            $array = [];
            array_push($array,'<div class="ingegre-total">Generado por '. $usuarios->name .' - '. date('m/d/Y g:ia').'</div>');
            array_push($array,'');
            array_push($array,'');
            array_push($output,$array);


            


            return response()->json($output);

        }

        



    }

   
}
