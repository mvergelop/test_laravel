<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngresosAdicionalesMovTemp extends Model
{
    //


    protected $table = 'ingresos_adicionales_mov_temp';
    protected $fillable = ['id','id_condominio','id_ingreso','fecha_proceso','monto','id_formapago','referencia'];
}
