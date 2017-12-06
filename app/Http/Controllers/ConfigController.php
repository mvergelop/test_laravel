<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//Librerias
use Input;
use Auth;

//Tablas 
use App\Config;


//Request
use App\Http\Requests\ConfigRequest;


class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::check()){
            if (Auth::user()-> tipo == '1'){
                $config = Config::count();
                if ($config == 0){
                    $config = New Config;
                }else {
                    $config = Config:: where ('id',1)
                                    -> first();
                }

                flashcountconfirmusers();

                return view ('config.index',compact('config'));

            } else {
                return view ('layouts.403');
            }
        } else {
            return view ('layouts.403');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

   
    public function store(ConfigRequest $request)
    {
        //obtenemos el campo file definido en el formulario

            $config = Config::count();

            return response()->json([$request]);

            if ($config == 1){
                $config_data = Config:: where ('id',1)
                                     -> first();
                

            }else {
                $config_data = New Config;
            }

            if (isset($request['adjunto1'])) {
                $file = Input::file('adjunto1');

                return response()->json([$file]);
               
                //Move Uploaded File
                $destinationPath = 'storage';
                $filename = 'Terminos_y_Condiciones.pdf';
                $file->move($destinationPath,$filename);
                $adjunto1 = public_path().'/storage/' .$filename;
                $adjunto1_filename = $filename;

            }else {
                $adjunto1 = $config_data->adjunto1;
                $adjunto1_filename = $config_data->adjunto1_filename;

            }
            
            if (isset($request['adjunto2'])) {
                $file = Input::file('adjunto2');
                //Move Uploaded File
                $filename = 'Manual_Usuario.pdf';
                $destinationPath = 'storage';
                $file->move($destinationPath,$filename);
                $adjunto2 = public_path().'/storage/' .$filename;
                $adjunto2_filename = $filename;
            }else {
                $adjunto2 = $config_data->adjunto2;
                $adjunto2_filename = $config_data->adjunto2_filename;

            }

            if (isset($request['adjunto3'])) {
                $file = Input::file('adjunto3');
                //Move Uploaded File
                $destinationPath = 'storage';
                $file->move($destinationPath,$file->getClientOriginalName());
                $adjunto3 = public_path().'/storage/' .$file->getClientOriginalName();
                $adjunto3_filename = $file->getClientOriginalName();
            }else {
                $adjunto3 = $config_data->adjunto3;
                $adjunto3_filename = $config_data->adjunto3_filename;

            }


            

            

            if ($config == 0) {
                Config:: create (['adjunto1' => $adjunto1,
                                  'adjunto1_filename' => $adjunto1_filename,  
                                  'adjunto2' =>$adjunto2,
                                  'adjunto2_filename' => $adjunto2_filename,
                                  'adjunto3' => $adjunto3,
                                  'adjunto3_filename' => $adjunto3_filename,
                                  'contacto' => $request['contacto'],
                                  'plan1'    => $request['plan1'],
                                  'plan2'    => $request['plan2'],
                                  'plan3'    => $request['plan3'],
                                  'plan4'    => $request['plan4'],
                                  'plan5'    => $request['plan5'],
                                  'plan6'    => $request['plan6']]);
            }else {
                Config:: where ('id',1)->update (['adjunto1' => $adjunto1,
                                                  'adjunto1_filename' => $adjunto1_filename,  
                                                  'adjunto2' =>$adjunto2,
                                                  'adjunto2_filename' => $adjunto2_filename,
                                                  'adjunto3' => $adjunto3,
                                                  'adjunto3_filename' => $adjunto3_filename,
                                                  'contacto' => $request['contacto'],
                                                  'plan1'    => $request['plan1'],
                                                  'plan2'    => $request['plan2'],
                                                  'plan3'    => $request['plan3'],
                                                  'plan4'    => $request['plan4'],
                                                  'plan5'    => $request['plan5'],
                                                  'plan6'    => $request['plan6']]);
            }
            $config_data = Config:: select ('adjunto1_filename','adjunto2_filename','adjunto3_filename') 
                                 -> where ('id',1)
                                 -> first();

            return Response()->json($config_data);
            
    }

}
