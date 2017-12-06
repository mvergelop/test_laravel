<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TipoGastosRequest;
use App\TipoGastos;
use App\Http\Controllers\Controller;
use Redirect;
use Session;
use Auth;
use URL;


class TipoGastosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getTipoGastos() {

        if (Auth::check()) {

            $tipogastos = TipoGastos::orderBy('descripcion')
                                    ->get();
            return response()->json($tipogastos);

        }
    }

    public function activar ($id){
        if (Auth::check()) {

            TipoGastos:: where ('id',$id)
                      -> update (['activo' => '1']);

            Session::flash('notify-head', 'Activado');
            Session::flash('notify-body', 'Tipo de gasto, activado correctamente');

            return Redirect::to ('/tipogastos');


        }

    }

    public function desactivar ($id){
        if (Auth::check()) {

            TipoGastos:: where ('id',$id)
                      -> update (['activo' => '0']);

            Session::flash('notify-head', 'Desactivado');
            Session::flash('notify-body', 'Tipo de gasto, desactivado correctamente');

            return Redirect::to ('/tipogastos');

        }        

    }


    public function index()
    {
        if (Auth::check()) {

            if (Auth::user()->tipo == '1') {
                $tipogastos = TipoGastos::orderBy('tipo')
                                  ->paginate(10);
                flashcountconfirmusers();
                return view ('tipogastos.index',compact('tipogastos'));

            }

            

        }
        
    }

   
    public function create()
    {

        

        if (Auth::check()){
            if (Auth::user()->tipo == '1'){
                $tipogasto = new TipoGastos;
                $action = URL::route('tipogastos.store');
                $method = 'POST';
                $button = 'Registrar';
                flashcountconfirmusers();
                return view ('tipogastos.createedit',compact('tipogasto','action','method','button'));


            }
        }

        
    }

    
    public function store(TipoGastosRequest $request)
    {


        TipoGastos::create ([
            'descripcion' => $request['descripcion'],
            'activo'      => $request['activo'],
            'tipo'        => $request['tipo']
            ]);

        Session::flash('notify-head', 'Registrado');
        Session::flash('notify-body', 'Tipo de gasto, registrado correctamente');

        return Redirect::to ('/tipogastos');
        
    }


    public function edit($id)
    {

        if (Auth::check()){
            if (Auth::user()->tipo == '1'){
                $tipogasto = TipoGastos:: where ('id',$id)
                                       -> first();
                $action = URL::route('tipogastos.update',['id' => $id]);
                $method = 'PUT';
                $button = 'Actualizar';
                flashcountconfirmusers();
                return view ('tipogastos.createedit',compact('tipogasto','action','method','button'));
            }

        }
        
    }

    public function update(Request $request, $id)
    {



        TipoGastos:: where ('id',$id)
                  -> update (['descripcion' => $request['descripcion'],
                              'activo'      => $request['activo'],
                              'tipo'        => $request['tipo']
                            ]);

        Session::flash('notify-head', 'Registrado');
        Session::flash('notify-body', 'Tipo de gasto, actualizado correctamente');

        return Redirect::to ('/tipogastos');
    }


}
