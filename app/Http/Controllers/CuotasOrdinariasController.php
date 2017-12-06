<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ViewCuotasGen;

class CuotasOrdinariasController extends Controller
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

            return view('cuotasordinarias.index',compact('cuotas'));
        } else { return view ('layouts.403');}

    }
    
}
