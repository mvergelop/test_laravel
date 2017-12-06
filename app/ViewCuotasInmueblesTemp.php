<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewCuotasInmueblesTemp extends Model
{
    protected $table = 'cuotas_inmuebles_temp_w';
    protected $fillable = ['id','id_condominio','aaaa','mes','id_inmueble','monto','extra','tipo','id_periodo','ocupante'];
}
