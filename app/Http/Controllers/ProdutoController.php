<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;


class ProdutoController extends Controller
{
    /**
     * Mostrando Lista de Produtos
     *
     * @param  \App\Produto  $model
     * @return \Illuminate\View\View
     */
    public function index(Produto $model)
    {
        return view('produtos.index', ['produtos' => $model->paginate(10)]);
    }

    /**
     * Mostrando view de criação de produto
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('produtos.create');
    }

    /**
     * Salvando um novo produto
     *
     * @param  \App\Produto  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Produto $model)
    {

        $model->create($request->all());
        return redirect()->route('produtos.index')->withStatus(__('Produto criado com sucesso.'));
    }

    /**
     * Tela de edição de produto
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\View\View
     */
    public function edit(Produto $produto)
    {
        return view('produtos.edit', compact('produto'));
    }

    /**
     * Atualizando produto específico
     *
     * @param  \App\Http\Requests\ProdutoRequest  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Produto  $produto)
    {

        $produto->update($request->all());
        return redirect()->route('produtos.index')->withStatus(__('Produto atualizado com sucesso.'));
    }

    /**
     * Remover produto
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Produto  $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index')->withStatus(__('Produto deletado com sucesso.'));
    }
}
