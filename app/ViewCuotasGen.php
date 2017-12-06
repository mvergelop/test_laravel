<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class ViewCuotasGen extends Model
{
    //


    protected $table = 'cuotas_gen_w';


    public static function getCuotas(){


		$cuotas = ViewCuotasGen:: where ('id_condominio', Auth::user()->id_condominio)
	                                         -> orderBy('created_at','desc')
	                                         -> orderBy('inmueble')
	                                         -> paginate(20);
	                                         
	    return $cuotas;

    }
    
}
