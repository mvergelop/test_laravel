<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condominios extends Model
{
    //


    protected $table = 'condominios';
    protected $fillable = ['nombre', 'id_fiscal' ,'direccion', 'administrador','url','tipo','cant_inmuebles','niveles','cant_niveles','id','periodo_inicial','tipo_cuota_defecto'];
}
