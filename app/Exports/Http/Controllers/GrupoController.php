<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grupo;
use App\Produto;
use App\Condicao;
class GrupoController extends Controller{

  /**
   * Mostrando Lista de Grupos
   *
   * @param  \App\Grupo  $model
   * @return \Illuminate\View\View
   */
  public function index(Grupo $model)
  {
      return view('grupos.index', ['grupos' => $model->paginate(10)]);
  }

  /**
   * Mostrando view de criação de grupo
   *
   * @return \Illuminate\View\View
   */
  public function create()
  {
      return view('grupos.create');
  }

  /**
   * Salvando um novo produto
   *
   * @param  \App\Grupo  $model
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request, Grupo $model)
  {

      $model->create($request->all());
      return redirect()->route('grupos.index')->withStatus(__('Grupo criado com sucesso.'));
  }

  /**
   * Tela de edição de produto
   *
   * @param  \App\Grupo  $produto
   * @return \Illuminate\View\View
   */
  public function edit(Grupo $grupo)
  {

    $condicaos = $grupo->condicoes;
    foreach($condicaos as $condicao){
      $condicao->produto = Produto::find($condicao->produto_id);
    }
      
      return view('grupos.edit', compact('grupo', 'condicaos'));
  }

  /**
   * Atualizando produto específico
   *
   * @param  \App\Http\Requests\GrupoRequest  $request
   * @param  \App\Grupo  $grupo
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(Request $request, Grupo $grupo)
  {

      $grupo->update($request->all());
      return redirect()->route('grupos.index')->withStatus(__('Grupo atualizado com sucesso.'));
  }

  /**
   * Remover grupo
   *
   * @param  \App\Grupo  $grupo
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy(Grupo  $grupo)
  {
      $grupo->delete();
      return redirect()->route('grupos.index')->withStatus(__('Grupo deletado com sucesso.'));
  }


}
