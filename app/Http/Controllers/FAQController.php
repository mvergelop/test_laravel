<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Request\FormasPagoRequest;
use App\Http\Controllers\Controller;
use App\FAQ;
use Redirect;
use Session;
use Auth;
use URL;
use Response;


class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function informacion()
    {
       return view ('faq.list');
    }

    public function dataInfo (){

         $FAQS = FAQ:: where ('mostrar','1')
                   -> select ('pregunta','respuesta') 
                   -> orderBy ('posicion')
                   -> get();

        return response()->json($FAQS);

    }


    public function mostrar ($id){

        if (Auth::check()){
            FAQ:: where ('id',$id)
                  -> update (['mostrar' =>'1']);

            Session::flash('notify-head', 'Actualizada');
            Session::flash('notify-body', 'FAQ actualizada correctamente');
            return Redirect::to ('/faq');
        }
    }

    public function ocultar ($id){

        if (Auth::check()){
            FAQ:: where ('id',$id)
                  -> update (['mostrar' =>'0']);

            Session::flash('notify-head', 'Actualizada');
            Session::flash('notify-body', 'FAQ actualizada correctamente');            
            return Redirect::to ('/faq');


        }
    }

     public function index()
    {
        $FAQS = FAQ:: orderBy ('posicion')
                   -> get();
        flashcountconfirmusers();
        return view ('faq.index',compact('FAQS'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function create()
    {

        if (user1Validator()){
            $FAQ = new FAQ;
            $action = URL::route('faq.store');
            $method = 'POST';
            $button = 'Registrar';
            flashcountconfirmusers();
            return view ('faq.createedit',compact('FAQ','action','method','button'));

        } else { return view ('layouts.403');}

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {
        if (user1Validator()){

            if (!isset($request['mostrar'])){
                $request['mostrar'] = 0;
            }
            
            FAQ:: create (['posicion' => $request['posicion'],
                           'pregunta' => $request['pregunta'],
                           'respuesta' => $request['respuesta'],
                           'mostrar' => $request['mostrar']]);

            Session::flash('notify-head', 'Registrada');
            Session::flash('notify-body', 'FAQ registrada correctamente');
            return Redirect::to('/faq');
        }
    }

    public function edit($id)
    {
        if (user1Validator()){
            $FAQ = FAQ:: where ('id',$id)
                                   -> first();
            $action = URL::route('faq.update', ['id' => $id]);
            $method = 'PUT';
            $button = 'Actualizar';
            flashcountconfirmusers();
            return view ('faq.createedit',compact('FAQ','action','method','button'));

        } else { return view ('layouts.403');}
    }

     public function update(Request $request, $id)
    {
        if (user1Validator()){

            if (!isset($request['mostrar'])){
                $request['mostrar'] = 0;
            }



            FAQ:: where ('id',$id)
                      -> update (['posicion' => $request['posicion'],
                                  'pregunta' => $request['pregunta'],
                                  'respuesta' => $request['respuesta'],
                                  'mostrar' => $request['mostrar']]);

            Session::flash('notify-head', 'Actualizada');
            Session::flash('notify-body', 'FAQ actualizada correctamente');
            return Redirect::to('/faq');



        }
    }

    public function destroy($id)
    {
        //
    }


    

    

   


    
  

    
   

   
   

    
   

    
    
}
