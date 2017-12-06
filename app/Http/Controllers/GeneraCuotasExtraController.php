<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


//Request 
use App\Http\Requests\GeneraCuotaExtraRequest;

//Librerias
use Auth;
use Redirect;
use Response;
use Session;

//Tablas Y Vistas
use App\ViewCuotasExtras;
use App\Condominios;
use App\CuotasInmuebles;
use App\MontoCuota;
use App\ViewCuotasOrdinarias;
use App\Inmuebles;

class GeneraCuotasExtraController extends Controller
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

                


                $periodos = ViewCuotasExtras::  where ('id_condominio' ,'=' ,Auth::user()-> id_condominio)
                                                -> orderBy('id')
                                                -> get();

                return view ('generacuotasextra.index',compact('cuota_val','periodos','tipo_cuota'));

            }

        }

        
    }

   
    public function store(GeneraCuotaExtraRequest $request)
    {

        if (Auth::check() && $request['periodo'] > 0) {
            $inmuebles = Inmuebles:: where ('id_condominio' ,'=' ,Auth::user()-> id_condominio)
                                  -> get();


            if (count($inmuebles) == 0){
                Session::flash('notify-head-error', 'Advertencia');
                Session::flash('notify-body-error', 'No hay inmuebles registrados para crear una cuota de condominio');
                return Redirect::to ('/generacuotasextra');
            } else {


                $periodo = ViewCuotasExtras:: where ('id' ,'=' ,$request['periodo'])
                                               -> where ('id_condominio' ,'=' ,Auth::user()-> id_condominio) 
                                               -> first();

                $array = [];

                array_push($array, array ('aaaa' => $periodo->aaaa, 'mes' => $periodo->mes ,'id' => $periodo->id, 'fecha_inicio'=> $periodo->fecha_inicio));

                $inicio_sigperiodo = $periodo->inicio_sigperiodo;

                for ($i=2; $i <= $request['cantcuotas'] ; $i++) { 

                	//2017-06-01

                	$inicio_sigperiodo = substr($inicio_sigperiodo,0,4).substr($inicio_sigperiodo,5,2).substr($inicio_sigperiodo,8,2);

                	$periodo = ViewCuotasExtras:: where ('fecha_inicio',$inicio_sigperiodo )
                                               -> where ('id_condominio' ,'=' ,Auth::user()-> id_condominio) 
                                               -> first();

                    array_push($array, array ('aaaa' => $periodo->aaaa, 'mes' => $periodo->mes ,'id' => $periodo->id, 'fecha_inicio'=> $periodo->fecha_inicio));

                    $inicio_sigperiodo = $periodo->inicio_sigperiodo;
                }

                
                //return Response()->json($array);
                



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

                    $monto = ($monto / floatval($request['cantcuotas']));

                    for ($i=0; $i < count($array)  ; $i++) { 

                    	CuotasInmuebles::create ([                        
                            'aaaa'      => $array[$i]['aaaa'],
                            'mes'       => $array[$i]['mes'],
                            'id_inmueble'      => $inmueble -> id,
                            'id_condominio'  => Auth::user()-> id_condominio,
                            'monto'     => $monto,
                            'extra'     => '1',
                            'id_periodo' => $array[$i]['id'],
                            'fecha_doc'  => $array[$i]['fecha_inicio']

                        ]);
                    	
                    }
                    
                
                    

                    

                   


                 } 
                
                
                return Redirect::to ('/generacuotasextra');

            }


        }
        

        
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
