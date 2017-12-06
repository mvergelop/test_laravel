<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//Tablas y Vistas
use App\Condominios;
use App\ViewPeriodosCerrados;
use App\PeriodosCerrados;

//Librerias 
use Auth;
use Response;

class AbrirPeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (user2Validator()) {

          $periodos = ViewPeriodosCerrados::getPeriodosAbrir();

          return view ('abrirperiodo.index',compact('periodos'));

        }else { return view ('layouts.403');}
    }
    
    public function store (Request $request){


        PeriodosCerrados:: where ('id',$request['id_periodo_cerrado'])
                        -> delete();

         createLog('Apertura de Periodo','Se ha abierto correctamente el periodo : <b>' . $request['periodo'].'</b>');

         return response()->json('OK');

    }

    

    public function periodosCerrados(){

        $periodos = ViewPeriodosCerrados::getPeriodosAbrir();
        return response()->json($periodos);

    }
    
}
