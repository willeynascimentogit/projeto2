<?php

namespace App\Http\Controllers;

use App\Condicao;
use App\Grupo;
use App\Produto;
use Illuminate\Http\Request;


class CondicaoController extends Controller
{
    /**
     * Mostrando Lista de Produtos
     *
     * @param  \App\Condicao  $model
     * @return \Illuminate\View\View
     */


    /**
     * Mostrando view de criação de condicao
     *
     * @return \Illuminate\View\View
     */
    public function create($grupo_id)
    {
        $grupo_id[0] = $grupo_id;
        return view('condicaos.create', ['produtos' => Produto::all(), 'grupo_id' => $grupo_id]);
    }

    /**
     * Salvando um novo condicao
     *
     * @param  \App\Condicao  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Condicao $model){
        $dados = $request->all();

        $grupo = Grupo::find($dados['grupo_id']);
        $grupo->condicoes()->create($dados);
        return redirect()->route('grupos.edit', $grupo)->withStatus(__('Condiçao criada com sucesso.'));
    }

    /**
     * Tela de edição de Condicao
     *
     * @param  \App\Condicao  $Condicao
     * @return \Illuminate\View\View
     */
    public function edit(Condicao $condicao)
    {
        $produtoSelecionado = Produto::find($condicao->produto_id);
        $produtos = array();
        foreach(Produto::all() as $produto){
          if($produtoSelecionado->id != $produto->id){
            $produtos[] = $produto;
          }
        }

        return view('condicaos.edit', compact('condicao', 'produtoSelecionado', 'produtos'));
    }

    /**
     * Atualizando condicao específico
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Condicao  $Condicao
     * @return \Illuminate\Http\RedirectResponse
     */
     public function update(Request $request, Condicao  $condicao)
     {

         $condicao->update($request->all());
         $grupo = Grupo::find($condicao->grupo_id);
         return redirect()->route('grupos.edit', $grupo)->withStatus(__('Condiçao excluída com sucesso.'));
     }

     /**
      * Remover Condicao
      *
      * @param  \App\Condicao  $produto
      * @return \Illuminate\Http\RedirectResponse
      */
     public function destroy(Condicao  $condicao)
     {
         $grupo = Grupo::find($condicao->grupo_id);
         $condicao->delete();
         return redirect()->route('grupos.edit', $grupo)->withStatus(__('Condiçao excluída com sucesso.'));
     }
}
