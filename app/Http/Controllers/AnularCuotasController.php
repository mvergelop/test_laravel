<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ViewCuotasGen;
use Response;
use App\ViewSaldosCuotasInmuebles;

class AnularCuotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (user2Validator()) {
        
            $cuotas = ViewCuotasGen::getCuotas();

            return view('anularcuotas.index',compact(('cuotas')));
        } else { return view ('layouts.403');}

    }

    public function buscar(Request $request){

        if ($request['filtro'] != ''){
            $cuotas = ViewSaldosCuotasInmuebles::where('id_condominio',Auth::user()->id_condominio)
                                           ->where ('tipo','0') 
                                           ->where('onto_original', '=','monto')
                                           ->whereRaw("des_inmueble like '%".$request['filtro']."%' or periodo like '%".$request['filtro']."%'")
                                           ->orderBy('id_periodo','des_inmueble');

        }else {
            $cuotas = ViewSaldosCuotasInmuebles::where('id_condominio',Auth::user()->id_condominio)
                                           ->where ('tipo','0') 
                                           ->where('onto_original', '=','monto')
                                           ->orderBy('id_periodo','des_inmueble');

        }

        



        return Response()->json($cuotas);

    }

    public function anular (Request $request){

    }
    
}
