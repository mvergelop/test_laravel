<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class Gastos extends Model
{
    //


    protected $table = 'gastos';
    protected $fillable = ['id','id_tipogasto','id_condominio','descripcion','activo','id_base'];


    public static function getCuentaProntoPago (){

    	return Gastos:: where ('id_base',26)
    				 -> where ('id_condominio',Auth::user()->id_condominio)
    				 -> select ('id','descripcion')
    				 -> first();

    }
}
