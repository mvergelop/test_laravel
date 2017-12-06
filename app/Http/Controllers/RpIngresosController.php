<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//Librerias
use Auth;
use Response;
use DB;

//Vistas y Tablas
use App\ViewCuotasInmueblesCob;

class RpIngresosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $array = getIdCondominio();
      $id_condominio = $array[0];
      $tipomenu = $array[1];

        return view ('reportes.ingresosperiodo',compact('tipomenu'));
    }

    public function getIngresosOrdinarios($idPeriodo){
        
        $array = getIdCondominio();
        $id_condominio = $array[0];
        $tipomenu = $array[1];

        if ($id_condominio > 0 ){

            $inmuebles = ViewCuotasInmueblesCob:: select ('monto','id_inmueble','inmueble','periodo','periodo_cobrado','id_periodo','fecha_doc')
                                               -> where ('extra',0)
                                               -> where ('id_condominio',$id_condominio)                                           
                                               -> orderBy ('id_inmueble')
                                               -> orderBy ('fecha_doc')
                                               -> get();

            $totalperiodo = ViewCuotasInmueblesCob:: select (DB::RAW ('IFNULL(sum(monto*-1),0) as monto'))
                                               -> where ('extra',0)
                                               -> where ('id_condominio',$id_condominio) 
                                               -> where ('id_periodo',$idPeriodo)
                                               -> where ('monto','<',0)
                                               -> first();

            $totalperiodo = $totalperiodo->monto;



            $array= [];
            $array2 = [];
            $id_inmueble = 0;
            $desInmueble = '';

            $inmueble = '';
            $totalInmueble  = 0 ;

            $keymax= count($inmuebles);


            foreach ($inmuebles as $key => $inmueble) {

                if ($key == 0) {
                    $array=[];
                    $idInmueble = $inmueble ->id_inmueble;
                    $desInmueble = $inmueble->inmueble;
                }

                if ($idInmueble == $inmueble ->id_inmueble) {
                    
                    if ($inmueble ->monto < 0 ){
                        $totalInmueble += $inmueble->monto*-1;     
                    }
                    

                   /* $a = array('monto' => formatNumber($inmueble->monto*-1),
                               'inmueble' => $inmueble->inmueble,
                               'periodo' => $inmueble->periodo_cobrado,
                               'porc' => porcentaje($inmueble->monto*-1,$totalperiodo),                                
                               );*/

                    $a = $this->generaArrayDet ($inmueble->monto,$inmueble->inmueble,$inmueble->id_periodo,$inmueble->periodo_cobrado,
                                         $inmueble->periodo_cobrado,$totalperiodo,$inmueble->monto_desc,$inmueble->fecha_doc);
                        

                    array_push($array, $a);

                }else {
                     

                    $a = array('monto' => formatNumber($totalInmueble),
                                'inmueble' => $inmueble->inmueble,
                                'porc' => formatNumber(porcentaje($totalInmueble,$totalperiodo)) , 
                                'detalle' => $array
                              );
                    array_push($array2, $a);

                    $idInmueble = $inmueble->id_inmueble;
                    $desInmueble = $inmueble->inmueble;
                    

                    if ($inmueble ->monto < 0 ){
                        $totalInmueble = $inmueble->monto*-1;   
                    }else {
                        $totalInmueble = 0;
                    }

                    $array=[];

                   
                   /* $a = array('monto' => formatNumber($inmueble->monto*-1),
                               'inmueble' => $inmueble->inmueble,
                               'periodo' => $inmueble->periodo,
                               'porc' => porcentaje($inmueble->monto*-1,$totalperiodo), 
                               );*/

                    $a = $this->generaArrayDet ($inmueble->monto,$inmueble->inmueble,$inmueble->id_periodo,$inmueble->periodo,
                                         $inmueble->periodo_cobrado,$totalperiodo,$inmueble->monto_desc,$inmueble->fecha_doc);


                    array_push($array, $a);

                }


                if ($keymax-1 == $key){
                     $a = array('monto' => formatNumber($totalInmueble),
                                'inmueble' => $inmueble->inmueble,
                                'porc' => formatNumber(porcentaje($totalInmueble,$totalperiodo)), 
                                'detalle' => $array
                              );

                }
                


                
            }
           
            return response()->json($array2);

        }

    }


    public function generaArrayDet ($monto,$inmueble,$id_periodo,$periodo,$periodoCobrado,$totalperiodo,$monto_desc,$fecha_doc){


        if ($monto < 0 && $id_periodo > 0 ){
            $detalle = 'Pago/Abono Cuota';
        }else if ($monto > 0 && $id_periodo > 0){
            $detalle = 'Cuota de Condominio';
        }else {
           $detalle = 'Pago/Abono Cuota';
        }

        $array = array('monto' => formatNumber($monto),
                               'inmueble' => $inmueble,
                               'periodo' => $periodo,
                               'periodocobrado' => $periodoCobrado, 
                               'porc' => formatNumber(porcentaje($monto,$totalperiodo)) , 
                               'detalle' => $detalle,
                               'fecha' =>$fecha_doc
                               );

        if ($monto_desc > 0){
            
            array_push($array, array('monto' => formatNumber($monto_desc),
                               'inmueble' => $inmueble,
                               'periodo' => $periodo,
                               'periodocobrado' => $periodoCobrado,
                               'porc' => formatNumber(porcentaje($monto_desc,$totalperiodo)), 
                               'detalle' => 'Descuento Pronto Pago',
                               'fecha' =>$fecha_doc
                               ));



        }
        return  $array;


    }

   
}


