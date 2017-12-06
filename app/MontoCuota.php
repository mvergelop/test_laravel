<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MontoCuota extends Model
{
    //


    protected $table = 'monto_cuota';
    protected $fillable = ['id','id_condomino','extra','monto'];
}
