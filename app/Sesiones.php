<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sesiones extends Model
{
    //


    protected $table = 'sesiones';
    protected $fillable = ['id','sesion_id','id_condominio','nombre_condominio'];
}
