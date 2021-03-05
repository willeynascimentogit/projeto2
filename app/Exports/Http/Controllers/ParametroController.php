<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parametro;
use App\Prazo;
use App\Pvencimento;
class ParametroController extends Controller{
  public function edit(){
      $parametros = Parametro::find(1);
      $prazos = Prazo::all();
      $registros = Pvencimento::all();
      $vencimentos = $registros->reject(function ($registros) {
        return $registros->vencimento == 30;
      });
      // dd($vencimentos);
      return view('parametros.edit', compact('parametros', 'prazos', 'vencimentos'));
  }

  public function update(Request $request, Parametro  $parametros)
  {

      $parametros->update($request->all());
      $prazos = Prazo::all();
      $vencimentos = Pvencimento::all();


      if(!isset($request->all()['prazo'])){
          return redirect()->route('parametros.edit')->withStatus('Você deve adicionar ao menos um prazo');
      }
      if(count($prazos) > 0){
        foreach($prazos as $p){

          Prazo::find($p->id)->delete();
        }
      }

      if(isset($request->all()['prazo'])){
        foreach($request->all()['prazo'] as $p){
          $info['prazo'] = $p;
          Prazo::create($info);
        }
      }

      $vencimentos = $vencimentos->reject(function ($vencimentos) {
        return $vencimentos->vencimento == 30;
      });



      foreach($vencimentos as $p){
        Pvencimento::find($p->id)->delete();

      }







      if(isset($request->all()['vencimento'])){
        foreach($request->all()['vencimento'] as $p){
          $info2['vencimento'] = $p;
          $v = Pvencimento::create($info2);
          // dd($v);
        }
      }
      // dd(Pvencimento::all());
      // dd($request->all());
      return redirect()->route('parametros.edit');
  }

}
