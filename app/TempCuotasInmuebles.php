<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempCuotasInmuebles extends Model
{
    //


    protected $table = 'temp_cuotas_inmuebles';
     protected $fillable = ['id_condominio','id_inmueble','id_periodo','extra','monto_base','monto'];






    public static function getDataTable($id_condominio){

        return TempCuotasInmuebles::where ('temp_cuotas_inmuebles.id_condominio',$id_condominio)
                             
                           ->join('inmuebles', function ($join) {
                                $join->on('temp_cuotas_inmuebles.id_inmueble', '=','inmuebles.id')
                                     ->on('temp_cuotas_inmuebles.id_condominio', '=','inmuebles.id_condominio');
                            })      
                            ->select ('temp_cuotas_inmuebles.id','temp_cuotas_inmuebles.id_condominio','temp_cuotas_inmuebles.id_inmueble','inmuebles.identificador','temp_cuotas_inmuebles.monto')    
                            ->orderBy('inmuebles.identificador')                
                           ->get();


    }
    
}
