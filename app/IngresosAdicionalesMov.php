<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngresosAdicionalesMov extends Model
{
    //


    protected $table = 'ingresos_adicionales_mov';
    protected $fillable = ['id','id_condominio','id_ingreso','fecha_proceso','monto','id_formapago','referencia'];
}
