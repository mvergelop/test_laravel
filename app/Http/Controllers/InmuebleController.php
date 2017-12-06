<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;



//Librerias
use Auth;
use Redirect;
use Session;
use URL;

//Request 
use App\Http\Requests\InmuebleRequest;

//Tablas 
use App\ViewPeriodosIniciales;
use App\Inmuebles;
use App\User;
use App\CuotasInmuebles;



class InmuebleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inmuebles = Inmuebles::where ('id_condominio','=',Auth::user()->id_condominio)
                                ->paginate(10);
        return view ("inmuebles.index",compact('inmuebles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {

            $user = User::where ('id',Auth::user()-> id)->first();
            if (($user['id_condominio']) > 0) {

                $count = Inmuebles:: where ('id_condominio',Auth::user()->id_condominio) 
                                  -> count();


                if ($count < Auth::user()->max_inmuebles) {
                    $periodoinicial = ViewPeriodosIniciales:: where ('id_condominio',Auth::user()->id_condominio)
                                                           -> select ('periodo') 
                                                           -> first();

                    $inmueble = new Inmuebles;
                    $action = URL::route('inmuebles.store');
                    $method = 'POST';
                    $button = 'Registrar';

                } else {
                    Session::flash('notify-head-error', 'Advertencia');
                    Session::flash('notify-body-error', 'No se pueden registrar mas inmuebles debido a su plan de licenciamiento');
                    return Redirect::to('/inmuebles');
                }

                

                return view ("inmuebles.createedit",compact('inmueble','action','method','button','periodoinicial'));    
            }else {
                return Redirect::to('condominio/create');
            }
        }else {
             return Redirect::to('/');
        }

    }

  
    public function store(InmuebleRequest $request)
    {

        if (!isset ($request['nivel'])){
            $request['nivel'] = '0';
        }

        Inmuebles::create([
                    'identificador'    => $request['identificador'],
                    'nivel'            => $request['nivel'],
                    'ocupante'         => $request['ocupante'],
                    'id_legal'         => $request['id_legal'],
                    'email'            => $request['email'],
                    'id_condominio'    => Auth::user()-> id_condominio,
                    'porc_cuota'       => $request['porc_cuota'],
                    'saldo_inicial'    => $request['saldo_inicial'],
                    'tipo' => $request['tipo']
                ]);

        createLog('Inmueble','Se ha cerrado correctamente el inmueble <b>'.$request['identificador'].'</b>, con un saldo inicial de <b>'.formatNumber($request['saldo_inicial']).'</b>');
        

        Session::flash('notify-head', 'Registrado');
        Session::flash('notify-body', 'El inmueble ha sido creado correctamente');
        return redirect('inmuebles');
    }

 
    public function edit($id)
    {
        if (Auth::check()) {

            $periodoinicial = ViewPeriodosIniciales:: where ('id_condominio',Auth::user()->id_condominio)
                                                       -> select ('periodo') 
                                                       -> first();

            $inmueble = Inmuebles:: where ('id',$id)
                                 -> first();
            $action = URL::route('inmuebles.update', ['id' => $id]);
            $method = 'PUT';
            $button = 'Modificar';

            $registros = CuotasInmuebles:: where ('id_inmueble',$id)
                                        -> where ('id_condominio',Auth::user()->id_condominio)
                                        -> get();

            if (count($registros)>0 ){
                $hayMov = 1;
            }else {
                $hayMov = 0;
            }


            return view ("inmuebles.createedit",compact('inmueble','action','method','button','hayMov','periodoinicial'));    

       }
    }


    public function update(InmuebleRequest $request, $id)
    {
        if (Auth::check()){

            if (!isset ($request['nivel'])){
                $request['nivel'] = '0';
            }

            $saldo_ant = Inmuebles:: where ('id',$id)
                                  -> select ('saldo_inicial')  
                                  -> first()->saldo_inicial;

            if ($saldo_ant <> $request['saldo_inicial'] ){
                createLog('Inmueble','Se detecto una modificacion de saldo inicial para el inmueble <b>'.$request['identificador'].'</b>, de <b>'.formatNumber($saldo_ant) .'</b> a <b>'.formatNumber($request['saldo_inicial']).'</b>');

            }



            Inmuebles:: where ('id',$id)
                     -> update ([ 
                        'identificador'    => $request['identificador'],
                        'nivel'            => $request['nivel'],
                        'ocupante'         => $request['ocupante'],
                        'id_legal'         => $request['id_legal'],
                        'email'            => $request['email'],
                        'porc_cuota'       => $request['porc_cuota'],
                        'saldo_inicial'    => $request['saldo_inicial'] ,
                        'tipo' => $request['tipo']
                        ]);

            Session::flash('notify-head', 'Actualizado');
            Session::flash('notify-body', 'El inmueble ha sido actualizado correctamente');
            return redirect('inmuebles');
        }
    }

}
