<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ViewCuotasGen;
use App\ViewCuotasAnular;
use App\CuotasInmuebles;
use Response;
use App\ViewGastosMovNoCerrados;
use App\GastosMov;

class AnularGastosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (user2Validator()) {
        
            

            return view('anulargastos.index');
        } else { return view ('layouts.403');}

    }

    public function buscar(Request $request){

        if ($request['filtro'] != ''){
            $gastos = ViewGastosMovNoCerrados::where('id_condominio',Auth::user()->id_condominio)                                        
                                          ->whereRaw("des_gasto like '%".$request['filtro']."%'")
                                           ->orderBy('fecha_doc','desc_gasto')
                                           ->get();

        }else {
            $gastos = ViewGastosMovNoCerrados::where('id_condominio',Auth::user()->id_condominio)                                        
                                           
                                           ->orderBy('fecha_doc','desc_gasto')
                                           ->get();

        }


       

        
    /*    dd($cuotas);*/


        return Response()->json($gastos);

    }

    public function anular (Request $request){


        createLog('Anular Gastos','Se ha Anulado un gasto : <b>' . $request['gasto'].'</b> por un monto de <b>' . $request['monto'] . ' con fecha <b>' .$request['fecha'].'</b>');

        GastosMov::where ('id',$request['id'])                       
                       ->delete();


        return Response()->json('OK'); 

    }
    
}
