<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;


//Request 
use App\Http\Requests\FormaPagoRequest;



//Tablas 
use App\FormasPago;
use App\ViewPeriodosIniciales;
use App\CuotasInmuebles;
use App\GastosMov;

//Librerias
use Redirect;
use Session;
use Auth;
use URL;


class FormasPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

        if (user2Validator()) {

            $formaspago = FormasPago:: where ('id_condominio',Auth::user()->id_condominio)
                                    -> orderBy ('descripcion')
                                    -> get();
            return view ('formaspago.index',compact('formaspago'));

        }else { return view ('layouts.403');}
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (user2Validator()) {
            $formapago = new FormasPago;
            $action = URL::route('formaspago.store');
            $method = 'POST';
            $button = 'Registrar';

            $periodoinicial = ViewPeriodosIniciales:: where ('id_condominio',Auth::user()->id_condominio)
                                                   -> select ('periodo') 
                                                   -> first();



            return view ('formaspago.createedit',compact('formapago','action','method','button','periodoinicial'));

        }else { return view ('layouts.403');}

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(FormaPagoRequest $request)
    {
        if (user2Validator()) {

            if (!isset($request['activo'])){
                $request['activo'] = 0;
            }
            
            FormasPago:: create ([
                    'id_condominio' => Auth::user()-> id_condominio,
                    'descripcion' => $request['descripcion'],
                    'saldo_inicial' => $request['saldo_inicial'],
                    'activo' => $request['activo']
                ]);

            createLog('Formas de Pago','Se ha cerrado correctamente la forma de pago <b>'.$request['descripcion'].'</b>, con un saldo inicial de <b>'.formatNumber($request['saldo_inicial']).'</b>');

            Session::flash('notify-head', 'Registrada');
            Session::flash('notify-body', 'Forma de Pago registrada correctamente');
            return Redirect::to('/formaspago');
        }else { return view ('layouts.403');}
    }


    public function edit($id)
    {
        if (user2Validator()) {
            $formapago = FormasPago:: where ('id',$id)
                                   -> first();
            $action = URL::route('formaspago.update', ['id' => $id]);
            $method = 'PUT';
            $button = 'Actualizar';

            $registros = CuotasInmuebles:: where ('forma_pago',$id)
                                        -> where ('id_condominio',Auth::user()->id_condominio)
                                        -> count();

            if ($registros > 0 ) {
                $hayMov = 1;
            }else {
                $hayMov = 0;
                $registros = GastosMov:: where ('id_condominio',Auth::user()->id_condominio)
                                      -> where ('id_formapago',$id)   
                                      -> count();
                if ($registros > 0 ) {
                  $hayMov = 1;
                }

            }

            $periodoinicial = ViewPeriodosIniciales:: where ('id_condominio',Auth::user()->id_condominio)
                                                   -> select ('periodo') 
                                                   -> first();



            return view ('formaspago.createedit',compact('formapago','action','method','button','periodoinicial','hayMov'));

        }else { return view ('layouts.403');}
    }

   

    public function update(FormaPagoRequest $request, $id)
    {
        if (user2Validator()) {

            if (!isset($request['activo'])){
                $request['activo'] = 0;
            }

            $saldo_ant = FormasPago:: where ('id',$id)
                                  -> select ('saldo_inicial')  
                                  -> first()->saldo_inicial;

            if ($saldo_ant <> $request['saldo_inicial'] ){
                createLog('Formas de Pago','Se detecto una modificacion de saldo inicial para la Forma de Pago <b>'.$request['descripcion'].'</b>, de <b>'.formatNumber($saldo_ant) .'</b> a <b>'.formatNumber($request['saldo_inicial']).'</b>');

            }



            FormasPago:: where ('id',$id)
                      -> update (['descripcion' => $request['descripcion'],
                                  'saldo_inicial' => $request['saldo_inicial'],
                                  'activo' => $request['activo']
                                ]);

            Session::flash('notify-head', 'Actualizada');
            Session::flash('notify-body', 'Forma de Pago actualizada correctamente');
            return Redirect::to('/formaspago');



        }else { return view ('layouts.403');}
    }

 
}
