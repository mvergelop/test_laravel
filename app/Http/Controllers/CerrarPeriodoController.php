<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PeriodosCerrados;
use App\PeriodosXCerrar;
use App\UltimosPeriodosCerrados;
use App\ViewPeriodosCerrados;
use App\GastosMovTemp;
use App\IngresosAdicionalesMovTemp;
use App\CuotasInmueblesTemp;
use App\Inmuebles;
use App\Email;

//Librerias 
use Auth;
use DB;

class CerrarPeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function periodosXCerrar(){

        if (user2Validator()) {

            $periodos = PeriodosXCerrar:: where ('id_condominio',Auth::user()->id_condominio)
                                       -> orderBy ('fecha_inicio')
                                       -> first();

            return response()->json([$periodos]);


        }

    }

    public function hayDataTemp($periodo){
        $cant = 0;

        if (user2Validator()) {
            $registros = GastosMovTemp:: select (DB::raw("count(*) as cantidad"))
                           -> where ('id_condominio',Auth::user()->id_condominio)
                           -> where ('fecha_proceso','>=', 
                                    DB::raw('(SELECT fecha_inicio FROM periodos_w  
                                    WHERE id = '.$periodo.' )'))
                           -> where ('fecha_proceso','<=',
                                  DB::raw('(SELECT fecha_final FROM periodos_w  
                                    WHERE id = '.$periodo.' )'))
                           -> first ()->cantidad;

            $cant += $registros; 

            $registros = CuotasInmueblesTemp:: select (DB::raw("count(*) as cantidad"))
                           -> where ('id_condominio',Auth::user()->id_condominio)
                           -> where ('fecha_doc','>=', 
                                    DB::raw('(SELECT fecha_inicio FROM periodos_w  
                                    WHERE id = '.$periodo.' )'))
                           -> where ('fecha_doc','<=',
                                  DB::raw('(SELECT fecha_final FROM periodos_w  
                                    WHERE id = '.$periodo.' )'))
                           -> first ()->cantidad;

            $cant += $registros; 

            $registros = IngresosAdicionalesMovTemp:: select (DB::raw("count(*) as cantidad"))
                           -> where ('id_condominio',Auth::user()->id_condominio)
                           -> where ('fecha_proceso','>=', 
                                    DB::raw('(SELECT fecha_inicio FROM periodos_w  
                                    WHERE id = '.$periodo.' )'))
                           -> where ('fecha_proceso','<=',
                                  DB::raw('(SELECT fecha_final FROM periodos_w  
                                    WHERE id = '.$periodo.' )'))
                           -> first ()->cantidad;

            $cant += $registros; 

            if ($cant > 0 ){
                return response()->json(['NOT OK']);
            }else {
                return response()->json(['OK']);
            }
            

        }

        

        

    }

    public function cierraPeriodo (Request $request) {

        if (user2Validator()) {
            $periodo = PeriodosXCerrar:: where ('id_condominio',Auth::user()->id_condominio)
                                       -> where ('id',$request['id_periodo']) 
                                       -> first();



            PeriodosCerrados::create ([
                    'id_periodo' => $request['id_periodo'],
                    'id_condominio' => Auth::user()->id_condominio,
                    'aaaa'          => $periodo->aaaa,
                    'mes'           => $periodo->mes,
                    'fecha_inicio'  => $periodo->fecha_inicio,
                    'fecha_final'  => $periodo->fecha_final

            
                ]);

            createLog('Cierre de Periodo','Se ha cerrado correctamente el periodo : <b>' . $periodo->periodo.'</b>');


            //SELECT ocupante,email FROM inmuebles

            $inmuebles = Inmuebles:: where ('id_condominio',Auth::user()->id_condominio)
                                  -> select ('ocupante','email')  
                                  -> get();

            $nombre_condominio = nombreCondominio();

            foreach ($inmuebles as $inmueble) {

                if (isset($inmueble->email)){
                    Email::create (['para'   => $inmueble->email, 
                                    'parms1' => $inmueble->ocupante,
                                    'parms2' => $periodo->periodo,
                                    'parms3' => $nombre_condominio,
                                    'parms4' => Auth::user()->id_condominio,
                                    'parms5' => $request['id_periodo'],
                                    'tipo'   => '120',
                                    'asunto' => 'Cierre de Periodo : '. $periodo->periodo . ' - ' . $nombre_condominio,
                                    'enviado' => '0'
                    ]);

                }                
            }



            /*
            UltimosPeriodosCerrados:: where ('id_condominio',Auth::user()->id_condominio)
                                   -> delete();

            $periodos = ViewPeriodosCerrados:: where ('id_condominio',Auth::user()->id_condominio)
                                            -> orderBy ('fecha_inicio','desc')
                                            -> limit(6)
                                            -> get();

            foreach ($periodos as $periodo) {


               

                UltimosPeriodosCerrados:: create (['id_condominio' => Auth::user()->id_condominio,
                                                   'id_periodo'    => $periodo->id_periodo,
                                                    'periodo'      => $periodo->periodo,
                                                    'fecha_inicio' => $periodo->fecha_inicio,
                                                    'fecha_final'  => $periodo->fecha_final]);

                    
                }


                
            */


            return response()->json(["OK " . $request['id_periodo']]);
        }
    }

    public function index()
    {

        if (user2Validator()) {

            $periodos = PeriodosXCerrar:: where ('id_condominio',Auth::user()->id_condominio)
                                       -> orderBy ('fecha_inicio')
                                       -> first();

            
            

            return view ('cerrarperiodo.index',compact('periodos'));


        } else { return view ('layouts.403');}

        
    }
}
