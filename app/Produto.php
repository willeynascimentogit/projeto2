<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Produto extends Model{

  public function grupo(){
    return $this->belongsTo(Grupo::class);
  }

  protected $fillable = [
    'nome', 'parcelaFixa',
  ];
}
