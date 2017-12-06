<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogAuditoria extends Model
{
    //


    protected $table = 'log_auditoria';
    protected $fillable = ['id_condominio','tipo','mensaje','time_at'];
}
