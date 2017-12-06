<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\GastosRequest;



//Librerias
use Auth;
use Redirect;
Use URL;
use Session;

//Tablas
use App\TipoGastos;
use App\Gastos;

class GastosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function desactivar ($id){

        if (user1Validator()) {
            Gastos:: where ('id',$id)
                  -> update (['activo' =>'0']);

            Session::flash('notify-head', 'Desactivado');
            Session::flash('notify-body', 'El gasto ha sido desactivado correctamente');
            return Redirect::to ('/gastos');
        } else { return view ('layouts.403');}
    }

    public function activar ($id){

        if (user1Validator()) {
            Gastos:: where ('id',$id)
                  -> update (['activo' =>'1']);
            Session::flash('notify-head', 'Activado');
            Session::flash('notify-body', 'El gasto ha sido activado correctamente');
            return Redirect::to ('/gastos');
        } else { return view ('layouts.403');}
    }


    public function index()
    {

        if (userValidator()) {

            if (Auth::user()->tipo == '1'){
                $id_condominio = 0;
            }else {
                $id_condominio = Auth::user()->id_condominio;
            }

            flashcountconfirmusers();

            $gastos = Gastos::join('tipo_gastos','tipo_gastos.id','=','gastos.id_tipogasto')
                          -> where ('id_condominio',$id_condominio)  
                          -> select ('gastos.id','gastos.descripcion','gastos.activo','tipo_gastos.descripcion as des_tipo')
                          -> orderBy  ('tipo_gastos.descripcion')
                          -> paginate(10);
                          

            return view ('gastos.index',compact('gastos','id_condominio'));

        } else { return view ('layouts.403');}

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (user1Validator()) {
            $tipogastos = TipoGastos::orderBy('descripcion')    
                                  ->get(['id','descripcion']);


            $gasto = new Gastos;
            $action = URL::route('gastos.store');
            $method = 'POST';
            $button = 'Registrar';
            $readonly = '';
            flashcountconfirmusers();
            return view ('gastos.createedit',compact('tipogastos','gasto','action','method','button','readonly'));

        }
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GastosRequest $request)
    {
        if (user1Validator()) {

            if (Auth::user()->tipo == '1') {
                $id_condominio = 0;
            }else{
                $id_condominio = Auth::user()->id_condominio;
            }

            Gastos::create([

                'id_tipogasto' => $request['tipogasto'],
                'id_condominio' => $id_condominio,
                'descripcion'  => $request['descripcion'],
                'activo'       => $request['activo'],
                'id_base'      => 0
                ]);

            Session::flash('notify-head', 'Registrado');
            Session::flash('notify-body', 'El gasto ha sido creado correctamente');
            return Redirect::to('/gastos');

        } else { return view ('layouts.403');}
        
    }

    
    public function edit($id)
    {
        if (user1Validator()) {


            $tipogastos = TipoGastos::orderBy('descripcion')    
                                  ->get(['id','descripcion']);

            $gasto = Gastos:: where ('id',$id)
                           -> first();
            $action = URL::route('gastos.update', ['id' => $id]);
            $method = 'PUT';
            $button = 'Actualizar';
            $readonly = '';
            flashcountconfirmusers();
            return view ('gastos.createedit',compact('tipogastos','gasto','action','method','button','readonly'));

        } else { return view ('layouts.403');}
        
    }

    
    public function update(GastosRequest $request, $id)
    {
         Gastos::  where ('id',$id)
                -> update(['id_tipogasto' => $request['tipogasto'],
                           'descripcion'  => $request['descripcion'],
                           'activo'       => $request['activo']]);

        Session::flash('notify-head', 'Actualizado');
        Session::flash('notify-body', 'El gasto ha sido actualizado correctamente');
        return Redirect::to('/gastos');
    }

    
    public function show($id)
    {
        if (user2Validator()){

            $tipogastos = TipoGastos::orderBy('descripcion')    
                                  ->get(['id','descripcion']);

            $gasto = Gastos:: where ('id',$id)
                           -> first();
            $action = URL::route('gastos.update', ['id' => $id]);
            $method = '';
            $button = '';
            $readonly = 'disabled';
            return view ('gastos.createedit',compact('tipogastos','gasto','action','method','button','readonly'));

        } else { return view ('layouts.403');} 
    }
}
