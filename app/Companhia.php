<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Companhia extends Model{


  public function usuarios(){
    return $this->hasMany(User::class);
  }

  public function grupo(){
    return $this->hasOne(Grupo::class);
  }

  protected $fillable = [
    'nome', 'cadastro', 'endereco', 'site', 'email', 'telefone', 'nomeContato', 'dataStatus', 'grupo_id',
  ];
}
