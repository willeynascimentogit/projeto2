<?php

namespace App\Http\Controllers;

use App\Companhia;
use App\Condicao;
use App\Produto;
use App\Grupo;
use Illuminate\Http\Request;

use App\Exports\CompanhiasExport;
use Maatwebsite\Excel\Facades\Excel;

class CompanhiaController extends Controller
{
    /**
     * Mostrando Lista de Produtos
     *
     * @param  \App\Companhia  $model
     * @return \Illuminate\View\View
     */

     public function excel(Request $req){
       $dados = $req->all();
       $registros = Companhia::all();

       $registros = new CompanhiasExport([$registros]);

       return Excel::download($registros, 'companhias.xlsx');
     }

    public function index(Companhia $model)
    {
        $companhias = $model->paginate(10);

        return view('companhias.index', compact('companhias'));
    }

    /**
     * Mostrando view de criação de companhia
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $condicaos = Condicao::all();
        foreach($condicaos as $condicao){
          $condicao->produto = Produto::find($condicao->produto_id);
        }
        $produtos = Produto::all();
        $grupos = Grupo::all();
        return view('companhias.create', compact('produtos', 'grupos'));
    }

    /**
     * Salvando um novo companhia
     *
     * @param  \App\Companhia  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Companhia $model)
    {
        $dadosCompanhia = $request->all();

        $companhia = $model->create($dadosCompanhia);

        return redirect()->route('companhias.index')->withStatus(__('Companhia criada com sucesso.'));
    }

    /**
     * Tela de edição de Companhia
     *
     * @param  \App\Companhia  $companhia
     * @return \Illuminate\View\View
     */
    public function edit(Companhia $companhia)
    {
        $grupos = Grupo::all();
        $companhia = Companhia::find($companhia->id);
        $grupoAt = Grupo::find($companhia->grupo_id);
        return view('companhias.edit', compact('companhia', 'grupos', 'grupoAt'));
    }

    /**
     * Atualizando companhia específico
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Companhia  $companhia
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Companhia  $companhia)
    {

        $companhia->update($request->all());
        if(isset($request->all()['condicoes'])){
          for($i=0; $i<count($request->all()['condicoes']); $i++){
            $dados['condicao_id'] = $request->all()['condicoes'][$i];
            $dados['companhia_id'] = $companhia->id;
            Grupo::create($dados);
          }
        }
        return redirect()->route('companhias.index')->withStatus(__('Companhia atualizada com sucesso.'));
    }

    /**
     * Remover Companhia
     *
     * @param  \App\Companhia  $produto
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Companhia  $companhia)
    {
        $companhia->delete();
        return redirect()->route('companhias.index')->withStatus(__('Companhia deletada com sucesso.'));
    }
}
