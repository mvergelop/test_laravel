<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CuotasInmuebles;
use Response;
use App\ViewCobrosInmueblesAnular;


class AnularCobrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (user2Validator()) {
        
            

            return view('anularcobros.index');
        } else { return view ('layouts.403');}

    }

    public function buscar(Request $request){

        if ($request['filtro'] != ''){
            $cobros = ViewCobrosInmueblesAnular::where('id_condominio',Auth::user()->id_condominio)                                        
                                          ->whereRaw("inmueble like '%".$request['filtro']."%'")
                                           ->orderBy('fecha_doc','inmueble')
                                           ->get();

        }else {
            $cobros = ViewCobrosInmueblesAnular::where('id_condominio',Auth::user()->id_condominio)
                                           ->orderBy('fecha_doc','inmueble')
                                           ->get();

        }


       

        
    /*    dd($cuotas);*/


        return Response()->json($cobros);

    }

    public function anular (Request $request){


    /*    dd($request);*/
        createLog('Anular Cobro','Se ha Anulado un gasto : <b>' . $request['inmueble']. ' / '. $request['periodo'].'</b> por un monto de <b>' . $request['monto'] . ' con fecha <b>' .$request['fecha'].'</b>');

        CuotasInmuebles::where ('id',$request['id'])                       
                       ->delete();


        return Response()->json('OK'); 

    }
    
}
