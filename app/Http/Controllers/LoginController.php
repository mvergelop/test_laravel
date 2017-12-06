<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Session;
use Redirect;

use Auth;


use Response;

//Tablas y Vistas 
use App\Condominios;
use App\ViewUsuarios;
use App\User;
use App\Sesiones;
use App\Config;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('usuarios.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoginRequest $request)

    {

        

        if ( (Auth::attempt(['login'=> $request['login'],'password' => $request['password']])) or 
             (Auth::attempt(['email'=> $request['login'],'password' => $request['password']])) ) {





            $user = ViewUsuarios:: where ('login',$request['login'])
                        -> orWhere('email',$request['login']) //Si ingresa por el email
                         ->first();

            $user->confirm = 1;
            $user->activo = 1;

            if ($user->confirm == '0'){
                Session::flash('notify-head-error', 'Advertencia');
                Session::flash('notify-body-error', 'El Login Ingresado no posee correo confirmado');
                Auth::logout();
                return Redirect::to ('/login');

            }else if ($user->activo == '0') {
                Session::flash('notify-head-error', 'Advertencia');
                Session::flash('notify-body-error', 'El Login Ingresado no se encuentra activo');
                Auth::logout();
                return Redirect::to ('/login');
            }else if ($user->dias_licencia <= 0 && $user->tipo == '2'){
                Session::flash('notify-head-error', 'Sin acceso');
                Session::flash('notify-body-error', 'Su licencia se encuentra actualmente vencida, por favor contacte al correo electronico soporte@netus.com.ve para cualquier duda');
                Auth::logout();
                return Redirect::to ('/login');
            }else if (is_null ($user->dias_licencia) && $user->tipo == '2'){
                Session::flash('notify-head-error', 'Sin acceso');
                Session::flash('notify-body-error', 'Su licencia no se encuentra activada, por favor contacte al correo electronico soporte@netus.com.ve para cualquier duda');
                Auth::logout();
                return Redirect::to ('/login');
            }else {
                Auth::user()->dias_licencia = $user->dias_licencia;

                $max_inmuebles = Config:: pluck ('plan'.$user->tipo_licencia);

                User::  where('email',$request['login'])
                      ->update(['dias_licencia' => $user->dias_licencia,
                                'max_inmuebles' => $max_inmuebles]);

                if (isset($user-> id_condominio)){

                    $nombre_condominio = Condominios::where ('id',$user->id_condominio)
                                                    ->value ('nombre');


                     User::  where('email',$request['login'])
                      ->update(['nombre_condominio' => $nombre_condominio]);

                   

                    return Redirect::to('/'); //URL CONDOMINIO
                    
                }else {
                    
                    if ($user['tipo'] == '2') {
                        if (isset($user['id_condomino'])) {
                            return Redirect::to('/');
                        } else {
                            return Redirect::to('/condominio/create');                    
                        }
                    }else {
                        return Redirect::to('/');
                    }
                }          

            }



              

        }else{
            Session::flash('notify-head-error', 'Advertencia');
            Session::flash('notify-body-error', 'La Combinacion de Login y Contraseña, es incorrecta.');
            return Redirect::to ('/login');
        }
    }

    public function logout(){
        if (Auth::check()){
            Auth::logout();    
        } else {
             Sesiones:: where ('sesion_id' , Session::getId())
                     -> delete();
        }
        
        return Redirect::to('/');
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
