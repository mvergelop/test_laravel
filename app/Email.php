<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    //


    protected $table = 'emails';
    protected $fillable = ['plantilla','asunto','para','cc','cco','tipo','enviado','parms1','parms2','parms3','parms4','parms5','mensaje'];
}
