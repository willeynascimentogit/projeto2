<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parametro;
use App\Prazo;
use Illuminate\Support\Facades\DB;
use App\Pvencimento;
class ParametroController extends Controller{

  public function choose(){
      $parametros = Parametro::all();
      return view('parametros.choose', compact('parametros'));
  }

  public function edit($id){
      $parametros = Parametro::find($id);
      $prazos = DB::table('prazos')->where('parametro_id', '=', $parametros->id)->get();
      $vencimentos = DB::table('pvencimentos')->where('parametro_id', '=', $parametros->id)->get();


      // dd($vencimentos);
      return view('parametros.edit', compact('parametros', 'prazos', 'vencimentos'));
  }

  public function update(Request $request, Parametro  $parametros)
  {

      $parametros->update($request->all());

      $prazos = DB::table('prazos')->where('parametro_id', '=', $parametros->id)->get();
      $vencimentos = DB::table('pvencimentos')->where('parametro_id', '=', $parametros->id)->get();


      if(!isset($request->all()['prazo'])){
          return redirect()->route('parametros.edit', $parametros->id)->withStatus('Você deve adicionar ao menos um prazo');
      }
      if(count($prazos) > 0){
        foreach($prazos as $p){

          Prazo::find($p->id)->delete();
        }
      }

      if(isset($request->all()['prazo'])){
        foreach($request->all()['prazo'] as $p){
          $info['prazo'] = $p;
          $info['parametro_id'] = $parametros->id;

          Prazo::create($info);
        }
      }

      // $vencimentos = $vencimentos->reject(function ($vencimentos) {
      //   return $vencimentos->vencimento == 30;
      // });



      foreach($vencimentos as $p){
        Pvencimento::find($p->id)->delete();

      }







      if(isset($request->all()['vencimento'])){
        foreach($request->all()['vencimento'] as $p){
          $info2['vencimento'] = $p;
          $info2['parametro_id'] = $parametros->id;
          $v = Pvencimento::create($info2);
          // dd($v);
        }
      }
      // dd(Pvencimento::all());
      // dd($request->all());
      return redirect()->back();
  }

}
