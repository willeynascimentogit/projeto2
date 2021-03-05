<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Prazo extends Model{

  protected $fillable = [
    'prazo', 'parametro_id',
  ];
    //
}
