<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

//Tablas y Vistas
use App\IngresosAdicionales;
use App\IngresosAdicionalesMov;
use App\IngresosAdicionalesMovTemp;
use App\FormasPago;
use App\PeriodosCerrados;


class RegistraIngresosAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function validaDatosTemp() {
        if (Auth::check()){

            $ingresosTemp = IngresosAdicionalesMovTemp::where ('ingresos_adicionales_mov_temp.id_condominio',Auth::user()->id_condominio)
                                                      ->join('ingresos_adicionales','ingresos_adicionales_mov_temp.id_ingreso', '=','ingresos_adicionales.id')
                                                      ->join ('formas_pago', 'ingresos_adicionales_mov_temp.id_formapago','=','formas_pago.id')
                                                      ->select ('ingresos_adicionales_mov_temp.id_condominio','ingresos_adicionales_mov_temp.id_ingreso','ingresos_adicionales.descripcion as des_ingreso','ingresos_adicionales_mov_temp.fecha_proceso','ingresos_adicionales_mov_temp.id_formapago','formas_pago.descripcion','ingresos_adicionales_mov_temp.monto','ingresos_adicionales_mov_temp.id')
                                                      ->get();


            foreach ($ingresosTemp as $ingresoTemp) {

                $cantidad = PeriodosCerrados:: where ('id_condominio',Auth::user()->id_condominio)
                                        -> where ('fecha_inicio','<=',$ingresoTemp->fecha_proceso)
                                        -> where ('fecha_final','>=',$ingresoTemp->fecha_proceso)
                                        -> count();

                if ($cantidad > 0 ){
                    return Response()->json (['NO OK']);
                }
                
            }        
            return Response()->json(['OK']); 

        }

    }

    public function ingresosTemp () {

        if (Auth::check()){

            $ingresosTemp = IngresosAdicionalesMovTemp::where ('ingresos_adicionales_mov_temp.id_condominio',Auth::user()->id_condominio)
                                                      ->join('ingresos_adicionales','ingresos_adicionales_mov_temp.id_ingreso', '=','ingresos_adicionales.id')
                                                      ->join ('formas_pago', 'ingresos_adicionales_mov_temp.id_formapago','=','formas_pago.id')
                                                      ->select ('ingresos_adicionales_mov_temp.id_condominio','ingresos_adicionales_mov_temp.id_ingreso','ingresos_adicionales.descripcion as des_ingreso','ingresos_adicionales_mov_temp.fecha_proceso','ingresos_adicionales_mov_temp.id_formapago','formas_pago.descripcion','ingresos_adicionales_mov_temp.monto','ingresos_adicionales_mov_temp.id')
                                                      ->get();
                                       
            return response()->json($ingresosTemp);
        }


    }

    public function procesaIngresosTemp(){

        if (Auth::check()){


            $ingresosTemp = IngresosAdicionalesMovTemp::where ('ingresos_adicionales_mov_temp.id_condominio',Auth::user()->id_condominio)
                                                      ->join('ingresos_adicionales','ingresos_adicionales_mov_temp.id_ingreso', '=','ingresos_adicionales.id')
                                                      ->join ('formas_pago', 'ingresos_adicionales_mov_temp.id_formapago','=','formas_pago.id')
                                                      ->select ('ingresos_adicionales_mov_temp.id_condominio','ingresos_adicionales_mov_temp.id_ingreso','ingresos_adicionales.descripcion as des_ingreso',
                                                        'ingresos_adicionales_mov_temp.fecha_proceso','ingresos_adicionales_mov_temp.id_formapago','formas_pago.descripcion','ingresos_adicionales_mov_temp.referencia','ingresos_adicionales_mov_temp.id','ingresos_adicionales_mov_temp.monto')
                                                      ->get();

            foreach ($ingresosTemp as $ingresoTemp) {
                IngresosAdicionalesMov::create([
                    'id_condominio'   => Auth::user()->id_condominio,
                    'id_ingreso'      => $ingresoTemp->id_ingreso,
                    'fecha_proceso'   => $ingresoTemp->fecha_proceso,
                    'monto'           => $ingresoTemp->monto,
                    'id_formapago'    => $ingresoTemp->id_formapago,
                    'referencia'      => $ingresoTemp->referencia

                ]);

                IngresosAdicionalesMovTemp::destroy($ingresoTemp->id);
                
            }
            return response()->json(["OK"]);
        }


    }




    public function index()
    {

        $ingresos = IngresosAdicionales:: where ('activo','1')
                        -> where ('id_condominio', Auth::user()->id_condominio)
                        -> get();

        $formaspago = FormasPago:: where ('activo',1)
                                -> where ('id_condominio',Auth::user()->id_condominio)
                                -> orderBy ('descripcion')
                                -> get();

        return view ('regingresosadi.index',compact('ingresos','formaspago'));
    }
    
    public function store(Request $request)
    {
        if (Auth::check()){

            //$monto = getNumberStr($request['monto']);
            $monto = $request['monto'];

             IngresosAdicionalesMovTemp::create([
                    'id_condominio'   => Auth::user()->id_condominio,
                    'id_ingreso'      => $request['id_ingreso'],
                    'fecha_proceso'   => $request['fecha_proceso'],
                    'monto'           => $monto,
                    'id_formapago'    => $request['id_formapago'],
                    'referencia'      => $request['referencia']

                ]);

            return response()->json(["OK"]);
        }
    }

    public function destroy($id)
    {
        IngresosAdicionalesMovTemp::destroy ($id);
        return response()->json(["OK"]);
    }
}
