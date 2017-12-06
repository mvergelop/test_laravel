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
use App\ViewSaldosCuotasInmuebles;

class ModificarCuotasController extends Controller
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

            return view('modificarcuotas.index',compact(('cuotas')));
        } else { return view ('layouts.403');}

    }

    public function buscar(Request $request){

        if ($request['filtro'] != ''){
            $cuotas = ViewCuotasAnular::where('id_condominio',Auth::user()->id_condominio)
                                         
                                           ->whereRaw("des_inmueble like '%".$request['filtro']."%'")
                                           ->orderBy('id_periodo','des_inmueble')
                                           ->get();

        }else {
            $cuotas = ViewCuotasAnular::where('id_condominio',Auth::user()->id_condominio)
                                         
                                           ->orderBy('id_periodo','des_inmueble')
                                           ->get();

        }


       

        
    /*    dd($cuotas);*/


        return Response()->json($cuotas);

    }

    public function modificar (Request $request){


        createLog('Modificar Cuota','Se ha Modificado una cuota : <b>' . $request['cuota'].'</b> a un monto de <b>' . $request['monto'] . '</b> para el inmueble <b>'.$request['inmueble'].' </b>');


        CuotasInmuebles::where ('id_condominio',Auth::user()->id_condominio)
                       ->where ('id_periodo',$request['id_periodo'])
                       ->where ('id_inmueble',$request['id_inmueble'])
                       ->update(['monto' => $request['monto']]);


        return Response()->json('OK'); 

    }
    
}
