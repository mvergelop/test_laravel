<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//Librearias
use Redirect;
use Auth;

//Tablas y Vistas
use App\User;
use App\Email;

//Requests 
use App\Http\Requests\UpdatePasswordRequest;

class UsrPasswordForgotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::check()) {
            return view ('usuarios.requestpassword');    
        } else{
            return Redirect::to('/');
        }
        
    }

    
    public function store(Request $request)
    {

        $cadena = generateRandomString(40);
        $mail = $request['email'];

        User:: where ('email',$mail)
            -> update (['confirmation_code' => $cadena]);

        Email::create ([
                    'tipo' => '110',
                    'parms1'  =>$mail,
                    'parms2'  =>$cadena,
                    'enviado' => '0 '
            ]);
        return view ('usuarios.lostpasswordsend',compact('mail'));

        
    }

    public function update (UpdatePasswordRequest $request){

        User:: where ('email' ,$request['email'])
            -> update (['password' => bcrypt($request['password']),
                        'confirmation_code' => '']);

        return view ('usuarios.lostpasswordcompleted');

        

    }

    public function changepassword () {

        if (userValidator()){

            $usuario = User:: where ('login',Auth::user()->login)
                       -> first ();

            return view ('usuarios.changepassword',compact('usuario')) ;


        }else { return view ('layouts.403');}

    }


    public function recuperar ($code){

        $usuario = User:: where ('confirmation_code',$code)
                       -> first ();

        return view ('usuarios.lostpasswordnew',compact('usuario')) ;

    }
}
