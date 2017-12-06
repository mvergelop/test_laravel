<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormasPago extends Model
{
    //


    protected $table = 'formas_pago';
    protected $fillable = ['id','id_condominio','descripcion','saldo_inicial','activo'];


    public static function getDesFormaPago ($idformapago) {

    	$des = FormasPago:: where ('id',$idformapago)
    					 -> select ('descripcion')	
    	 				 -> first();

    	return $des->descripcion;

    }

}
