<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Librerias 
use Auth;

class ViewPeriodosCerrados extends Model
{
    //


    protected $table = 'periodos_cerrados_w';


    public static function getPeriodosAbrir(){
		$fecha_inicio = Condominios:: where ('condominios.id',Auth::user()->id_condominio)
                      -> join ('periodos_w','condominios.periodo_inicial','=','periodos_w.id')
    								  -> select ('periodos_w.fecha_inicio')
    								  -> first()->fecha_inicio;

    	$periodos = ViewPeriodosCerrados:: where ('id_condominio',Auth::user()->id_condominio)
        								-> where ('fecha_inicio','>=',$fecha_inicio)
        								-> OrderBy ('fecha_inicio','desc')
                                        -> select ('id','periodo')
        								-> get();

       	return $periodos;
    }
    
}
