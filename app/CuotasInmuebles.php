<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuotasInmuebles extends Model
{
    //


    protected $table = 'cuotas_inmuebles';
    protected $fillable = ['id','id_condominio','aaaa','mes','id_inmueble','monto','extra','tipo','id_periodo','ocupante','forma_pago','fecha_doc','anticipo','pronto_pago','monto_desc'];
}
