<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//Librerias 
use DB;

//Tablas 
use App\LogAuditoria;
use App\ViewPeriodos;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (userReportValidator()){

            $array = getIdCondominio();
            $id_condominio = $array[0];
            $tipomenu = $array[1];

            $periodos = ViewPeriodos:: select ('periodo','id','periodo_actual')
                                    -> orderBy('fecha_inicio','desc')
                                    -> take(24)
                                    -> get();

            return view ('log.index',compact('periodos','tipomenu'));
        } else {return view ('layouts.403');}
    }

    public function show(Request $request){

        

        if (userReportValidator()){

            $array = getIdCondominio();
            $id_condominio = $array[0];
            $tipomenu = $array[1];

            $registros = LogAuditoria:: where ('id_condominio',$id_condominio)
                                     -> where ('created_at','>=',DB::raw('(SELECT fecha_inicio FROM periodos_w  
                                                                           WHERE id = '.$request['id_periodo'].' )'))
                                     -> where ('created_at','<=',DB::raw('(SELECT fecha_final FROM periodos_w  
                                                                          WHERE id = '.$request['id_periodo'].' )'))
                                     -> get();

            return response()->json($registros);

        } else {return view ('layouts.403');}



    }
}
