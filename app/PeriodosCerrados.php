<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeriodosCerrados extends Model
{
    //
    protected $table = 'periodos_cerrados';
    protected $fillable = ['id_periodo','id_condominio','aaaa','mes','fecha_inicio','fecha_final'];
}
