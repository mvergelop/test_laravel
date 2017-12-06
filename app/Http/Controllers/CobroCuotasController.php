<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;

//Tablas y Vistas
use App\CuotasInmueblesTemp;
use App\ViewCuotasInmueblesTemp;
use App\CuotasInmuebles;
use App\ViewCuotasInmuebles;
use App\ViewCuotasOrdinarias;
use App\Inmuebles;
use App\CuotasOrdinarias;
use App\FormasPago;
use App\PeriodosCerrados;
use App\ViewSaldosCuotasInmuebles;
use App\Gastos;
use App\GastosMov;

class CobroCuotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function montoCuota ($idInmueble,$idPeriodo,$extra) {

        if (user2Validator()) {

            $saldo = ViewSaldosCuotasInmuebles:: where ('id_inmueble',$idInmueble)
                                              -> where ('id_periodo',$idPeriodo)
                                              -> where ('id_condominio',Auth::user()->id_condominio)
                                              -> where ('extra',$extra)
                                              -> select('monto','extra')
                                              -> first();


            return Response()->json($saldo);
        }


    }

    public function validaFecha (Request $request) {
        if (user2Validator()) {

            $cantidad = PeriodosCerrados:: where ('id_condominio',Auth::user()->id_condominio)
                                        -> where ('fecha_inicio','<=',$request['fecha'])
                                        -> where ('fecha_final','>=',$request["fecha"])
                                        -> count();

            if ($cantidad == 0 ){return Response()->json (['ABIERTO']);}
            else {return Response()->json (['CERRADO']);}



        }
    }

    public function periodosInmueble($id_inmueble){


       
        if (user2Validator()) {
            $periodos = ViewSaldosCuotasInmuebles::where ('id_condominio', '=',Auth::user()->id_condominio)
                                       ->where ('id_inmueble','=',$id_inmueble)
                                       ->orderBy('id_periodo')
                                       ->get();

            return response()->json($periodos);
            //return Response::json(array($periodos)); 

        }else { return response()->json(["respuesta"]);}

        

    }

    public function procesaCuotasTemp(Request $request){
        if (user2Validator()) {

            $cuotasInmueblesTemp = CuotasInmueblesTemp:: where   ('id_condominio','=',Auth::user()->id_condominio)
                                                      -> orderBy ('id')
                                                      -> get     ();   

            $gasto_pronto_pago = Gastos::getCuentaProntoPago();

            foreach ($cuotasInmueblesTemp as $cuotaInmuebleTemp) {
                
                CuotasInmuebles::create ([
                    'id_condominio' => Auth::user()->id_condominio,
                    'id_inmueble'   => $cuotaInmuebleTemp->id_inmueble,
                    'id_periodo'    => $cuotaInmuebleTemp->id_periodo,
                    'monto'         => $cuotaInmuebleTemp->monto,
                    'aaaa'          => $cuotaInmuebleTemp->aaaa,
                    'mes'           => $cuotaInmuebleTemp->mes,
                    'ocupante'      => $cuotaInmuebleTemp->ocupante,
                    'forma_pago'    => $cuotaInmuebleTemp->forma_pago,
                    'fecha_doc'     => $cuotaInmuebleTemp->fecha_doc,
                    'referencia'    => $cuotaInmuebleTemp->referencia,
                    'extra'         => $cuotaInmuebleTemp->extra,                    
                    'pronto_pago'   => $cuotaInmuebleTemp->pronto_pago,
                    'monto_desc'    => $cuotaInmuebleTemp->monto_desc
                    
                    ]);

                if ($cuotaInmuebleTemp->monto_desc > 0){
                    

                    $desformapago = FormasPago::getDesFormaPago($cuotaInmuebleTemp->forma_pago);

                    GastosMov::create([
                        'id_condominio' => Auth::user()->id_condominio,
                        'id_gasto'      => $gasto_pronto_pago->id,
                        'des_gasto'     => $gasto_pronto_pago->descripcion,
                        'documento'     => '',
                        'fecha_doc'     => $cuotaInmuebleTemp->fecha_doc,
                        'id_proveedor'  => 0,
                        'des_proveedor' => 'PRONTO PAGO',
                        'monto'         => $cuotaInmuebleTemp->monto_desc,
                        'fecha_proceso' => $cuotaInmuebleTemp->fecha_doc,
                        'id_formapago'  => $cuotaInmuebleTemp->forma_pago,
                        'des_formapago' => $desformapago 

                    ]);
                }

                CuotasInmueblesTemp::destroy($cuotaInmuebleTemp->id);

            }

            return response()->json(['OK']); 
        } 
    }

    public function cuotasTemp(){

        if (user2Validator()) {


            $cuotasInmueblesTemp = ViewCuotasInmueblesTemp:: where   ('id_condominio','=',Auth::user()->id_condominio)
                                                          -> orderBy ('id')
                                                          -> get     ();     
            return response()->json($cuotasInmueblesTemp);                     
        }
    }

  
    public function index()
    {

        if (user2Validator()) {
            $inmuebles = Inmuebles::where ('id_condominio','=',Auth::user()->id_condominio)
                                  ->orderBy('identificador')  
                                  ->get();

            $formaspago = FormasPago:: where ('activo',1)
                                    -> where ('id_condominio', Auth::user()->id_condominio)
                                    -> orderBy ('descripcion')
                                    -> get();

            return view ('cobros.index',compact('inmuebles','formaspago'));

        }else {return view ('layouts.403');}
        
    }
    
    public function store(Request $request)
    {
        if (user2Validator()) {


            
                                       
            $ocupante = Inmuebles:: where ('id_condominio' ,'=' ,Auth::user()->id_condominio) 
                                 -> where ('id','=',$request['id_inmueble'])
                                 -> value ('ocupante');

            $periodo = CuotasOrdinarias:: where ('id' ,'=' ,$request['id_periodo'])
                                       -> first ();
            if ($request['id_periodo'] == '0') {
                $aaaa = 0;
                $mes  = 0;
            }else {
                $aaaa = $periodo->aaaa;
                $mes  = $periodo->mes;
            }

            //$monto = getNumberStr($request['monto'])*-1;
            //$monto = getNumberStr($request['monto'])*-1;
            $monto = $request['monto']*-1;

            //eturn response()->json ([ $request['monto'] . ' ' . $monto]);

            if ($request['pronto_pago'] == 'no'){
                $monto_desc = 0;
            }else {
                $monto_desc = $request['monto_desc'];
            }

            CuotasInmueblesTemp::create ([
                'id_condominio' => Auth::user()->id_condominio,
                'id_inmueble'   => $request['id_inmueble'],
                'id_periodo'    => $request['id_periodo'],
                'monto'         => $monto,
                'aaaa'          => $aaaa,
                'mes'           => $mes,
                'ocupante'      => $ocupante,
                'forma_pago'    => $request['forma_pago'],
                'fecha_doc'     => $request['fecha_doc'],
                'extra'         => $request['extra'],
                'pronto_pago'   => $request['pronto_pago'],
                'monto_desc'    => $monto_desc
                ]);

            

            return response()->json (["OK"]);
        }

    }

    public function destroy($id)
    {

        if (user2Validator()) {
            CuotasInmueblesTemp::destroy($id);
            return response()->json (["OK ".$id]);
        }

    }
}
