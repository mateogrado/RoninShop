<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $table = "notifications";
    protected $fillable = ['id_remitente','id_destinatario','nombre_remitente','nombre_destinatario','asunto','mensaje','visto'];
}
