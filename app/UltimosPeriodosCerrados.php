<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UltimosPeriodosCerrados extends Model
{
    //
    protected $table = 'ultimos_periodoscerrados';
    protected $fillable = ['id_periodo','id_condominio','fecha_inicio','fecha_final','periodo'];
}
