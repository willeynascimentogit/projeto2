<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pvencimento extends Model{

  protected $fillable = [
    'vencimento', 'parametro_id',
  ];
    //
}
