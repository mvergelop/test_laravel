<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewCuotasInmuebles extends Model
{
    //


    protected $table = 'cuotas_inmuebles_w';
    protected $fillable = ['id_periodo','id_condominio','id_inmueble','id_periodo','aaaa','mes','monto'];
}
