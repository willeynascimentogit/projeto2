<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Calculo extends Model{
  protected $fillable = [
    'nomeSindico', 'nomeCondominio', 'chave', 'cnpjCondominio', 'prazo',  'dataEmissao',  'primeiroVencimento',  'comissaoInst',  'custoTed',  'custoBoleto',
     'tipoFinanciamento',  'comissaoParc',  'comissaoConCred',  'tac',  'iof',  'valorFinanciamento', 'valorFinanciado',  'valorFinanciadoAt', 'parcela', 'user_id' , 'diasPrimeiroVenc', 'data', 'parcelaFixa'
  ];

}
