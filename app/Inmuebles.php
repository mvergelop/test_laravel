<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inmuebles extends Model
{
    //


    protected $table = 'inmuebles';
    protected $fillable = ['id','id_condominio','nivel','identificador','ocupante','id_legal','email','saldo_inicial','tipo'];
}
