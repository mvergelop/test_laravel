<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewCuotasOrdinarias extends Model
{
    //


    protected $table = 'cuotas_ordinarias_w';
    protected $fillable = ['id','id_condominio','periodo','aaaa','mes'];
}
