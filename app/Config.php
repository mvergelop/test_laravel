<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    //


    protected $table = 'config';
    protected $fillable = ['adjunto1','adjunto2','adjunto1_filename','adjunto2_filename','adjunto3','adjunto3_filename','contacto','plan1','plan2','plan3','plan4','plan5','plan6'];


    public static function getInmuebles($tipo_licencia) {


    	$max_inmuebles = Config:: pluck ('plan'.$tipo_licencia);

    	return $max_inmuebles;

    }
}
