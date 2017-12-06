<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;

use Session;
use Redirect;
use Auth;
use URL;
use Reponse;

//Modelos
use App\User;
use App\Email;
use App\Config;


class UsuarioController extends Controller
{    
    public function index () {
        
    	$users = User::getUsers();
        
        flashcountconfirmusers();
        $titulo = 'Listado de Usuarios';
    	return view ("usuarios.index",compact('users','titulo'));
    }

    public function porAprobar () {
        
        $users = User:: where ('activo',0) -> where ('confirm',1) -> orderBy ('login')->paginate(10);
        flashcountconfirmusers();
        $titulo = 'Listado de Usuarios por Aprobar';
        return view ("usuarios.index",compact('users','titulo'));
    }

    public function create () {

        $pasar = 0;
        if (!Auth::check()) {
            $pasar = 1;
        }else {
            if (Auth::user()-> tipo=='1'){
                $pasar = 1;
            }

        }

        if ($pasar == 1){
            $user = new User;
            $action = URL::route('usuarios.store');
            $method = 'POST';
            $button = 'Registrar';
            $vencimiento = '';


            return view("usuarios.createedit",compact('user','action','method','button','vencimiento'));

        }

    	
    }

    

    public function store (UserCreateRequest $request) {

        
        $activo = '0';
        $confirm  = '0';

        $dia = substr($request['vencimiento'], 0,2);  
        $mes = substr($request['vencimiento'], 3,2) ; 
        $anio = substr($request['vencimiento'], 6,4); 

        $vencimiento = $anio.$mes.$dia;

        if (!Auth::check()){
            $tipo = '2';
            $tipo_licencia = '1';

        }else {
            $tipo = $request['tipo'];
            $tipo_licencia = $request['tipo_licencia'];

            if (Auth::user()->tipo == '1') {
                $activo = $request['activo'];
                $confirm  = $request['confirm'];
            }

        }




        $confirmation_code = generateRandomString(50);
    	
    	User::create([
    		'login'    => $request['email'],
    		'name'     => $request['name'],
    		'email'    => $request['email'],
    		'password' => bcrypt($request['password']),
            'activo'   => $activo,
            'tipo'     => $tipo,
            'tipo_licencia' => $tipo_licencia,
            'vencimiento' => $vencimiento,
            'confirmation_code' => $confirmation_code,
            'confirm' => $confirm,
            'max_inmuebles' => Config::getInmuebles($tipo_licencia)

    	]);
        
        Email:: create (['tipo' => '100',
                         'enviado' => '0',
                         'parms1' => $request['login']]);

        if (Auth::check()) {
            if (Auth::user()-> tipo == 1) {
                return Redirect::to('/usuarios');
            }            
        }else {
            $nombre = $request['name'];
            $email = $request['email'];
            return view ('usuarios.registrado',compact('nombre','email'));
        }


    	
    }

    public function edit ($idLogin){

        
        $user = User::where ('login',$idLogin)->first();
        $action = URL::route('usuarios.update',['login' => $idLogin]);
        $method = 'PUT';
        $button = 'Actualizar';


        


        $dia = substr($user->vencimiento, 8,2); 
        $mes = substr($user->vencimiento, 5,2) ; 
        $anio = substr($user->vencimiento, 0,4);  

        //$vencimiento = $anio.$mes.$dia;
        $vencimiento = $dia.'/'.$mes.'/'.$anio;

        return view("usuarios.createedit",compact('user','action','method','button','vencimiento'));
    }



    public function activar ($idLogin){



        if (Auth::check() == true and Auth::user()->tipo == '1') {


            $user = User::where ('login',$idLogin)->first();
                
            User::where('login',$idLogin)
            ->update([ 'activo'       => '1']);

            Session::flash('notify-head', 'Activado');
            Session::flash('notify-body', 'Usuario '. $idLogin . ', activado correctamente');

            return Redirect::to ('/usuarios');

        }else {
            return Redirect::to ('/');
        }

        //return Redirect::to ('/');

    }

    public function desactivar ($idLogin){



        if (Auth::check() == true and Auth::user()->tipo == '1') {


            $user = User::where ('login',$idLogin)->first();
                
            User::where('login',$idLogin)
            ->update([ 'activo'       => '0']);

            Session::flash('notify-head', 'Desactivado');
            Session::flash('notify-body', 'Usuario '. $idLogin . ', desactivado correctamente');

            return Redirect::to ('/usuarios');

        }else {
            return Redirect::to ('/');
        }

        //return Redirect::to ('/');

    }

    public function update (UserCreateRequest $request){   

        $dia = substr($request['vencimiento'], 0,2);  
        $mes = substr($request['vencimiento'], 3,2) ; 
        $anio = substr($request['vencimiento'], 6,4); 
        
        $vencimiento = $anio.$mes.$dia;

        $user_tipo = User:: where ('login',$request['login'])
                          -> value('tipo');
                          
        
        if ($user_tipo == '1') {
            $tipo = '1';    
        }else {
            $tipo = $request['tipo'];
        }


        echo $request['confirm'];

        if (Auth::user()->tipo == '1'){
            User::where('login',$request['login'])
                ->update([ 'name'       => $request['name'],
                           'email'   =>    $request['email'],
                           'tipo'     => $tipo,
                            'tipo_licencia' => $request['tipo_licencia'],
                            'vencimiento' => $vencimiento,
                            'activo' => $request['activo'],
                            'confirm' => $request['confirm']
                          ]);

        }else{
            User::where('login',$request['login'])
                ->update([ 'name'       => $request['name']]);
        }

        Session::flash('notify-head', 'Actualizado');
        Session::flash('notify-body', 'Usuario actualizado correctamente');

        if (Auth::user()->tipo =='1'){
            return Redirect::to('/usuarios');
        }else {
            return Redirect::back();
        }

        
        

    }
}
