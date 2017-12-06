<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


//Librerias 
use Auth;
use Redirect;
use Session;

//Requests 

use App\Http\Requests\GeneraCuotasRequest;

//Tablas
use App\Condominios;
use App\CuotasInmuebles;
use App\MontoCuota;
use App\ViewCuotasOrdinarias;
use App\Inmuebles;
use App\TempCuotasInmuebles;

class GeneraCuotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::check()){
            if (Auth::user()-> id_condominio > 0){
                $cuota = CuotasInmuebles::where ('id_condominio','=', Auth::user()-> id_condominio)
                                ->where ('monto','>','0')
                                ->orderBy('id','desc')
                                -> get(['monto'])
                                -> first();

                $tipo_cuota = Condominios::where ('id',Auth::user()->id_condominio)
                                         ->value('tipo_cuota_defecto');
                if (!isset($tipo_cuota)){
                    $tipo_cuota = '1';
                }


                if (!isset ($cuota)){
                    $cuota_val = 0;
                }else {
                    $cuota_val = $cuota-> monto;
                }
                $cuota_val = 0;

                


                $periodos = ViewCuotasOrdinarias:: where ('id_condominio' ,'=' ,Auth::user()-> id_condominio)
                                                -> orderBy('id')
                                                -> get();

                return view ('generacuotas.index',compact('cuota_val','periodos','tipo_cuota'));

            }

        }

        
    }


    public function storeTempSave (Request $request){

        TempCuotasInmuebles::where ('id',$request['id'])
                           ->update(['monto'=> $request['monto']]);


        return Response()->json('OK');
    }


    public function storeTemp (GeneraCuotasRequest $request)
    {




        if (Auth::check() && $request['periodo'] > 0) {


            TempCuotasInmuebles::where('id_condominio',Auth::user()-> id_condominio)
                               ->delete();


            $inmuebles = Inmuebles:: where ('id_condominio' ,'=' ,Auth::user()-> id_condominio)
                                  -> get();

            if (count($inmuebles) == 0){
                Session::flash('notify-head-error', 'Advertencia');
                Session::flash('notify-body-error', 'No hay inmuebles registrados para crear una cuota de condominio');
                return Redirect::to ('/generacuotas');
            } else {

                $periodo = ViewCuotasOrdinarias:: where ('id' ,'=' ,$request['periodo'])
                                               -> where ('id_condominio' ,'=' ,Auth::user()-> id_condominio) 
                                               -> first();




                $temporales = [];
                foreach ($inmuebles as $inmueble) {

                    

                    if ($request['tipo_cuota'] == '1'){
                        $monto = $request['cuotaordinaria'];

                    }else {

                        if (!isset($inmueble->porc_cuota)){
                            $monto = 0;
                        }else {

                            $monto = $inmueble->porc_cuota * (floatval($request['cuotaordinaria']) / 100);
                        }
                    }
                    
                
                    TempCuotasInmuebles::create ([                                                   
                            'id_inmueble'      => $inmueble -> id,
                            'id_condominio'  => Auth::user()-> id_condominio,
                            'monto'     => $monto,
                            'monto_base'     => $monto,
                            'extra'     => '0',
                            'id_periodo' => $periodo ->id
                    ]);





                }

                return Response()->json(TempCuotasInmuebles::getDataTable(Auth::user()-> id_condominio));


                //return Redirect::to ('/generacuotas');                
                
            }




        }else {
            return Response()->json('NOT OK');
        }
        

        
    }

   
    public function guardar()
    {


        if (Auth::check()) {





            $inmuebles = TempCuotasInmuebles::where('id_condominio',Auth::user()-> id_condominio )->get();


            if (count($inmuebles) == 0){

                Session::flash('notify-head-error', 'Advertencia');
                Session::flash('notify-body-error', 'No hay inmuebles registrados para crear una cuota de condominio');
                return Redirect::to ('/generacuotas');
            } else {

             


             
                $periodo = '';
                foreach ($inmuebles as $inmueble) {

                    if ($periodo == ''){
                       $periodo = ViewCuotasOrdinarias:: where ('id' ,'=' , $inmueble->id_periodo)
                                               -> where ('id_condominio' ,'=' ,Auth::user()-> id_condominio) 
                                               -> first();
 
                    }
                  
                       
                                            
                    $monto = $inmueble->monto;
                    
                
                    CuotasInmuebles::create ([                        
                            'aaaa'      => $periodo->aaaa,
                            'mes'       => $periodo->mes,
                            'id_inmueble'      => $inmueble -> id_inmueble,
                            'id_condominio'  => Auth::user()-> id_condominio,
                            'monto'     => $monto,
                            'extra'     => '0',
                            'id_periodo' => $periodo ->id,
                            'fecha_doc'  => $periodo->fecha_inicio

                        ]);

                    

                    $anticipos = CuotasInmuebles:: where ('id_condominio',Auth::user()-> id_condominio)
                                                -> where ('id_periodo',0)
                                                -> where ('id_inmueble',$inmueble -> id)
                                                -> where ('monto','<',0)
                                                -> get();

                    if (count($anticipos)>0) {

                        foreach ($anticipos as $anticipo) {
                            if (abs($anticipo->monto) > $monto ) {

                                CuotasInmuebles::create ([                        
                                    'aaaa'      => $periodo->aaaa,
                                    'mes'       => $periodo->mes,
                                    'id_inmueble'      => $inmueble -> id,
                                    'id_condominio'  => Auth::user()-> id_condominio,
                                    'monto'     => $monto*-1,
                                    'extra'     => '0',
                                    'id_periodo' => $periodo ->id,
                                    'fecha_doc'  => $anticipo->fecha_doc,
                                    'forma_pago' => $anticipo->forma_pago,
                                    'anticipo'   => '1'

                                ]);


                                CuotasInmuebles:: where ('id',$anticipo->id)
                                               -> update (['monto' => $anticipo->monto +$monto]); 


                                break 1;
                            }else {
                                CuotasInmuebles::create ([                        
                                    'aaaa'      => $periodo->aaaa,
                                    'mes'       => $periodo->mes,
                                    'id_inmueble'      => $inmueble -> id,
                                    'id_condominio'  => Auth::user()-> id_condominio,
                                    'monto'     => $anticipo->monto,
                                    'extra'     => '0',
                                    'id_periodo' => $periodo ->id,
                                    'fecha_doc'  => $anticipo->fecha_doc,
                                    'forma_pago' => $anticipo->forma_pago,
                                    'anticipo'   => '1'

                                ]);

                                CuotasInmuebles:: where ('id',$anticipo->id)
                                               -> update (['monto' => 0]); 

                                $monto = $monto - $anticipo->monto;

                            }

                        }

                    }




                }
                TempCuotasInmuebles::where ('id_condominio',Auth::user()->id_condominio)
                                   ->delete(); 
                return Response()->json('OK');       
                
            }




        }
        

        
    }

}
