<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


//Librerias
use Auth;
use Redirect;
use Session;
use Response;
use Mail;
use Storage;
use Url;


//Tablas y Vistas
use App\Sesiones;
use App\Config;


class IndexController extends Controller
{
    public function index () {

    	if (Auth::check()){

            if (isset(Auth::user()->id_condominio)) {
                $tipomenu = '2';
                return view ('reportes.agrupado',compact('tipomenu'));

            }else {
                if (Auth::user()->tipo == '1') {
                    $tipomenu = '1';
                    flashcountconfirmusers();
                    return view ("index",compact('tipomenu'));
                } else {
                    Redirect::to ('/condominio/create');
                }

                
            }		
			    		
    	}else {
            return view ("index");

    	}

    	
    }

    public function sendEmail(){
        $title = "HOLA";
            $content = "PRUEBA";

            Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message)
            {

                $message->from('vergelmelvin@gmail.com', 'Christian Nwamba');

                $message->to('vergelmelvin@gmail.com');

            });

    }

    public function urlCondominio($url){


        if (Auth::check()){
            return Redirect::to ('/');
        }else 

            if (createSesion($url,0)){

                $tipomenu = '3';

                return view ('reportes.agrupado',compact('tipomenu'));

            }else {
                return Redirect::to ('/');
            }
        }



    
    public function precios (){

        $img_precios = Config:: select ('adjunto3_filename')
                             -> first()->adjunto3_filename;

        return view ('precios',compact('img_precios'));

    }

    
}
