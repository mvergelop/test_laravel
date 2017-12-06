<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//Librearias
use Auth;

//Request 
use App\Http\Request\RegistraGastosRequest;

//Vistas 
use App\Gastos;
use App\ViewGastos;
use App\GastosMov;
use App\GastosMovTemp;
use App\FormasPago;

class RegistraGastosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function gastosTemp () {

        if (Auth::check()){

            $gastosTemp = GastosMovTemp:: where ('id_condominio',Auth::user()-> id_condominio)
                                       -> orderBy ('id')
                                       -> get();
                                       
            return response()->json($gastosTemp);
        }


    }

    public function procesaGastosTemp(){

        if (Auth::check()){


            $gastosTemp = GastosMovTemp::where ('id_condominio',Auth::user()->id_condominio)
                                       ->get();




            foreach ($gastosTemp as $gastoTemp) {

                $desformapago = FormasPago::getDesFormaPago($gastoTemp->id_formapago);

                GastosMov::create([
                    'id_condominio' => Auth::user()->id_condominio,
                    'id_gasto'      => $gastoTemp->id_gasto,
                    'des_gasto'     => $gastoTemp->des_gasto,
                    'documento'     => $gastoTemp->documento,
                    'fecha_doc'     => $gastoTemp->fecha_doc,
                    'id_proveedor'  => $gastoTemp->id_proveedor,
                    'des_proveedor' => $gastoTemp->des_proveedor,
                    'monto'         => $gastoTemp->monto,
                    'fecha_proceso' => $gastoTemp->fecha_proceso,
                    'id_formapago'  => $gastoTemp->id_formapago,
                    'des_formapago' => $desformapago 

                ]);

                GastosMovTemp::destroy($gastoTemp->id);
                
            }
            return response()->json(["OK"]);
        }


    }




    public function index()
    {

        $gastos = ViewGastos::getGastosCombo();

        if (count($gastos)> 0 ){
            $tipogasto = $gastos[0]->tipogasto;
        }
        $agregado = 0;


        $formaspago = FormasPago:: where ('activo',1)
                                    -> where ('id_condominio', Auth::user()->id_condominio)
                                    -> orderBy ('descripcion')
                                    -> get();

        return view ('registrogastos.index',compact('gastos','formaspago','tipogasto','agregado'));
    }
    
    public function store(Request $request)
    {
        if (Auth::check()){

            $des_gasto = Gastos::where ('id',$request['id_gasto'])
                               ->value ('descripcion'); 

            GastosMovTemp::create([
                    'id_condominio' => Auth::user()->id_condominio,
                    'id_gasto'      => $request['id_gasto'],
                    'des_gasto'     => $des_gasto,
                    'documento'     => $request['documento'],
                    'fecha_doc'     => $request['fecha_doc'],
                    'id_proveedor'  => $request['id_proveedor'],
                    'des_proveedor' => $request['des_proveedor'],
                    'monto'         => $request['monto'],
                    'fecha_proceso' => $request['fecha_proceso'],
                    'id_formapago'  => $request['id_formapago']


                ]);

            return response()->json(["OK"]);
        }
    }

    public function destroy($id)
    {
        GastosMovTemp::destroy ($id);
        return response()->json(["OK"]);
    }
}
