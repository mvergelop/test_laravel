<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


//Tablas y Vistas
use App\Email;

//Librerias
use URL;
use Session;
use Auth;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $action = URL::route('contacto.store');
        $nombre = '';
        $correo_electronico = '';
        $readonly = '';
        if (Auth::Check()){
            $nombre = Auth::user()->name;
            $correo_electronico = Auth::user()->email;
            $readonly = 'readonly';
        }
        return view ('contacto.index',compact('action','nombre','correo_electronico','readonly'));

        


    }


    public function store(Request $request)


    {
/*
        <option value="1" selected>Información</option>
                                  <option value="2">Soporte</option>
                                  <option value="3">Aviso de Pago</option>
                                  <option value="4">Solicitud de Instructivos</option>*/


        switch ($request["motivo"]) {
            case '1':
                $motivo = 'Información';
                break;
            case '2':
                $motivo = 'Soporte';
                break;
            case '3':
                $motivo = 'Aviso de Pago';
                break;
            case '4':
                $motivo = 'Solicitud de Instructivos';
                break;
        }


        Email::create (['para'   => $request['correo_electronico'], 
                        'parms1' => $request['nombre'],

                        'tipo'   => '130',
                        'asunto' => $request['asunto'],
                        'mensaje' => $request['mensaje'],
                        'enviado' => '0'
        ]);



        Session::flash('notify-head', 'Registrado');
        Session::flash('notify-body', 'Se ha enviado su formulario correctamente.');
        return redirect('contacto');
    }

   
}
