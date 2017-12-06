<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

//Tablas 
use App\IngresosAdicionales;

//Librerias
use Redirect;
use Session;
use Auth;
use URL;
use Response;

//Request 
use App\Http\Requests\IngresosAdicionalesRequest;




class IngresosAdicionalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   

    public function activar ($id){
        if (Auth::check()) {

            IngresosAdicionales:: where ('id',$id)
                               -> update (['activo' => '1']);

            Session::flash('notify-head', 'Activado');
            Session::flash('notify-body', 'Ingreso Adicional, activado correctamente');

            return Redirect::to ('/ingresosadicionales');


        }

    }

    public function desactivar ($id){
        if (Auth::check()) {

            IngresosAdicionales:: where ('id',$id)
                               -> update (['activo' => '0']);

            Session::flash('notify-head', 'Desactivado');
            Session::flash('notify-body', 'Ingreso Adicional, desactivado correctamente');

            return Redirect::to ('/ingresosadicionales');

        }        

    }


    public function index()
    {
        if (Auth::check()) {
            $ingresosadicionales = IngresosAdicionales::orderBy('descripcion')
                                -> where ('id_condominio',Auth::user()->id_condominio)
                                 ->paginate(10);

            
            return view ('ingresosadi.index',compact('ingresosadicionales'));
        }
        
    }

   
    public function create()
    {

        

        if (Auth::check()){
            $ingresoadicional = new IngresosAdicionales;
            $action = URL::route('ingresosadicionales.store');
            $method = 'POST';
            $button = 'Registrar';

            return view ('ingresosadi.createedit',compact('ingresoadicional','action','method','button'));
        }

        
    }

    
    public function store(IngresosAdicionalesRequest $request)
    {

        if (Auth::check()){

            if (Auth::user()->tipo == '1'){
                $id_condominio = '0';

            }else {
                $id_condominio = Auth::user()->id_condominio;
            }


            IngresosAdicionales::create (['descripcion' => $request['descripcion'],
                                        'activo'      => $request['activo'],
                                        'id_condominio' => $id_condominio
                                      ]);

            Session::flash('notify-head', 'Registrado');
            Session::flash('notify-body', 'Ingreso Adicional, registrado correctamente');

            return Redirect::to ('/ingresosadicionales');

        }


        
        
    }


    public function edit($id)
    {

        if (Auth::check()){
            if (Auth::user()->tipo == '1'){
                $ingresoadicional = IngresosAdicionales:: where ('id',$id)
                                                       -> first();
                $action = URL::route('ingresosadicionales.update',['id' => $id]);
                $method = 'PUT';
                $button = 'Actualizar';

                return view ('ingresosadi.createedit',compact('ingresoadicional','action','method','button'));
            }

        }
        
    }

    public function update(IngresosAdicionalesRequest $request, $id)
    {



        IngresosAdicionales:: where ('id',$id)
                           -> update (['descripcion' => $request['descripcion'],
                                       'activo'      => $request['activo']
                                     ]);

        Session::flash('notify-head', 'Actualizado');
        Session::flash('notify-body', 'Ingreso Adicional, actualizado correctamente');

        return Redirect::to ('/ingresosadicionales');
    }


}
