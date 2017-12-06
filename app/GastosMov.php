<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GastosMov extends Model
{
    //


    protected $table = 'gastos_mov';
    protected $fillable = ['id','id_condominio','id_gasto','des_gasto','documento','fecha_doc','id_proveedor','des_proveedor','monto','observaciones','id_formapago','des_formapago','fecha_proceso'];
}
