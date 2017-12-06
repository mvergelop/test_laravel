<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Librerias
use Auth;

class ViewGastos extends Model
{
    //
    protected $table = 'gastos_w';


    public static function getGastosCombo(){
    	$data = ViewGastos:: where ('activo','1')
                        -> where ('id_condominio', Auth::user()->id_condominio)
                        -> select ('id','descripcion','tipogasto')
                        -> orderBy ('tipogasto','desc')
                        -> orderBy ('descripcion')
                        -> get();

        return $data;
    }

    
}
