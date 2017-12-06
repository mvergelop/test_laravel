<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
    //


    protected $table = 'ciudades';
    protected $fillable = ['id_ciudad', 'id_estado', 'ciudad', 'capital'];


    public static function getCiudades(){

    	$data = Ciudades:: select ('id_ciudad','ciudad')	
    					-> orderBy('ciudad')
    					-> get();
    	return $data;

    }
}
