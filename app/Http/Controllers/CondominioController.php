<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CondominioRequest;
use Session;
use Redirect;
use Auth;

use URL;

//Tablas y Vistas 
use App\Condominios;
use App\User;
use App\CuotasOrdinarias;
use App\PeriodosCerrados;
use App\ViewPeriodos;
use App\Gastos;
use App\Ciudades;

class CondominioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function existeUrl($url){

        if (user2Validator()) {
            $cant = Condominios:: where ('url',$url) 
                               -> count();
            
            return response()->json([$cant]); 
        }
    }


    public function index()
    {

        if (user2Validator()) {

            $user = User::  where ('login',Auth::user()->login)
                          ->where ('id_condominio','>',0)
                          ->first();

            

            if (count($user)> 0 ) {
                return Redirect::to('condominio/edit');
            }else {
                return Redirect::to('condominio/create');
            }
        } else { return view ('layout.403');}

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (user2Validator()) {

            $cuotasordinarias = CuotasOrdinarias:: select(DB::raw("concat(cast(aaaa as char(4)),'-',lpad(mes,2,'0')) AS periodo, id"))
                                                -> where ('aaaa',date('Y'))
                                                -> orderBy('id')
                                                -> get();
            $cuotaordinaria = New CuotasOrdinarias;

            $condominio = New Condominios;
            $action = URL::route('condominio.store');
            $method = 'POST';
            $button = 'Registrar';

            $ciudades = Ciudades::getCiudades();

            switch (Auth::user()->tipo) {
                case '1':
                    return view ('condominio.createedit',compact('cuotasordinarias','cuotaordinaria','condominio','action','method','button','ciudades'));
                    break;
                case '2':
                    $users = User::where('id',Auth::user()->id)->first();
                    if (isset ($users['id_condominio'])){
                        return Redirect::to ('/condominio/edit');
                    }else {
                        return view ('condominio.createedit',compact('cuotasordinarias','cuotaordinaria','condominio','action','method','button','ciudades'));
                    }
                    break;
            }

        } else { return view ('layout.403');}       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CondominioRequest $request){


        if (user2Validator()) {

            if (!isset($request['niveles'])) {
                $request['niveles'] = 0;
            }

            Condominios::create([
                        'nombre'         => $request['nombre'],
                        'direccion'      => $request['direccion'],
                        'tipo'           => $request['tipo'],
                        'cant_inmuebles' => $request['cant_inmuebles'],
                        'niveles'        => $request['niveles'],
                        'cant_niveles'   => $request['cant_niveles'],
                        'periodo_inicial' => $request['periodo'],
                        'tipo_cuota_defecto' => $request["tipo_cuota"],
                        'ciudad'           => $request['ciudad'],
                        'url'               => $request["url"]
                    ]);

            

            $condominio = Condominios::orderBy ('id','desc')->first();

            User::where('login',Auth::user()->login)
                ->update([ 'id_condominio'       => $condominio -> id,
                           'nombre_condominio' => $request['nombre']]);


            $periodo = ViewPeriodos:: Where ('fecha_final' ,'<',
                                          DB::raw('(SELECT fecha_inicio FROM periodos_w  
                                                    WHERE id = '.$condominio->periodo_inicial.' )'))
                                       -> orderBy ('fecha_inicio','desc')
                                       -> first(); 

           
            
            PeriodosCerrados::create ([
                        'id_periodo' => $periodo -> id,
                        'id_condominio' => $condominio -> id,
                        'aaaa'          => $periodo->aaaa,
                        'mes'           => $periodo->mes,
                        'fecha_inicio'  => $periodo->fecha_inicio,
                        'fecha_final'  => $periodo->fecha_final

                    ]);


            $gastos = Gastos:: where ('id_condominio',0)
                              -> get ();



            foreach ($gastos as $gasto) {

                Gastos:: where ('id_base',$gasto->id)
                      -> update(['id_tipogasto' => $gasto->id_tipogasto,
                                 'descripcion'  => $gasto->descripcion,
                                 'activo'       => $gasto->activo]);


                

                  $cant = 0;
                  $cant = Gastos:: where ('id_base',$gasto->id)
                                -> where ('id_condominio',$condominio->id)
                                -> count();

                  if ($cant == 0){
                    Gastos:: create(['id_tipogasto'  => $gasto->id_tipogasto,
                                     'descripcion'   => $gasto->descripcion,
                                     'activo'        => $gasto->activo,
                                     'id_base'       => $gasto->id,
                                     'id_condominio' => $condominio->id]);
                  }              
            }
              



            return Redirect::to ('/');
        }
    }


 
    public function edit()
    {
        if (user2Validator()) {
            $condominio = Condominios:: where ('id',Auth::user()->id_condominio)
                                 -> first();

            $cuotaordinaria = CuotasOrdinarias:: select(DB::raw("concat(cast(aaaa as char(4)),'-',lpad(mes,2,'0')) AS periodo, id"))
                                                -> where ('id', $condominio->periodo_inicial)
                                                -> first();
            $cuotasordinarias = [];
            $ciudades = Ciudades::getCiudades();

            $action = URL::route('condominio.update',['id'=>Auth::user()->id_condominio]);
            $method = 'PUT';
            $button = 'Actualizar';


            return view ('condominio.createedit',compact('cuotaordinaria','cuotasordinarias','condominio','action','method','button','ciudades'));

        } else { return view ('layout.403');}   
        
    }

  
    public function update(CondominioRequest $request, $id)
    {
        if (user2Validator()) {


            Condominios::where ('id',$request['id']) 
                       ->update ([
                            'nombre'         => $request['nombre'],
                            'direccion'      => $request['direccion'],
                            'tipo'           => $request['tipo'],
                            'cant_inmuebles' => $request['cant_inmuebles'],
                            'niveles'        => $request['niveles'],
                            'cant_niveles'   => $request['cant_niveles'],
                            'administrador'  => $request['administrador'],
                            'tipo_cuota_defecto' => $request["tipo_cuota"],
                            'ciudad'           => $request['ciudad'],
                            'url'               => $request["url"]
                        ]) ;

            User::where('login',Auth::user()->login)
                ->update([ 'nombre_condominio' => $request['nombre']]);

            return Redirect::to('/');

        }
    }
    

    public function destroy($id)
    {
        //
    }
}
