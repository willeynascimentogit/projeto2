<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Parametro extends Model{

  protected $fillable = [
    'comissaoCondcred', 'comissaoInst', 'custoTed', 'custoBoleto', 'iofDiario', 'iofAdicional', 'iofFixo', 'sobreParceiro', 'valorInstituicao',
  ];
    //
}
