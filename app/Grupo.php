<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use App\Condicao;
use App\Produto;

class Grupo extends Model{
    protected $fillable = [
      'nome',
    ];

    public function condicoes(){
      return $this->hasMany(Condicao::class);
    }

    public static function recuperarGrupo($companhia_id){
      $condicaosAtuais = DB::table('grupos')->where('companhia_id', $companhia_id)->get();
      foreach ($condicaosAtuais as $condicao) {
        $condicao->cada = Condicao::find($condicao->condicao_id);
        $condicao->cada->produto = Produto::find($condicao->cada->produto_id);
      }
      return $condicaosAtuais;
    }

    public static function verificarExiste($companhia_id, $condicao_id){
      $condicaosAtuais = DB::table('grupos')->get();

      foreach ($condicaosAtuais as $condicao) {
        if($condicao->companhia_id == $companhia_id && $condicao->condicao_id == $condicao_id){
          return true;
        }
      }
      return false;
    }
}
