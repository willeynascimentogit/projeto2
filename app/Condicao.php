<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use App\Grupo;

class Condicao extends Model{

    public function produto(){
      return $this->hasOne(Produto::class);
    }

    public function grupo(){
      return $this->belongsTo(Grupo::class);
    }

    protected $fillable = [
      'id', 'valorFinanciamento', 'valorFinAte', 'mesesMin', 'mesesMax', 'taxa', 'comissaoParc', 'comissaoConCred', 'produto_id', 'grupo_id', 'parametro_id',
    ];

    public static function recuperarCondicaos($companhia_id){
      $condicaos = DB::table('condicaos')->get();

      $retorno = array();
      foreach($condicaos as $condicao){
        if(!Grupo::verificarExiste($companhia_id, $condicao->id)){
          $retorno[] = $condicao;
        }
      }

      return $retorno;
    }

}
