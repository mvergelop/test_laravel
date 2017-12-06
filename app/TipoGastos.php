<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoGastos extends Model
{
    //


    protected $table = 'tipo_gastos';
    protected $fillable = ['id','descripcion','activo','tipo'];
}
