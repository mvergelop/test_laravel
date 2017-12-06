<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngresosAdicionales extends Model
{
    //


    protected $table = 'ingresos_adicionales';
    protected $fillable = ['id','descripcion','activo','id_condominio'];
}
