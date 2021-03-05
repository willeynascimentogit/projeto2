@extends('layouts.app', ['activePage' => 'calculo-management', 'titlePage' => __('Gerenciamento de Cálculos')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Simulações') }}</h4>
                <p class="card-category"> {{ __('Aqui você pode visualizar os cálculos') }}</p>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">

                  <div class="col-sm-12">

                    <h4>Filtro</h4>
                    <form class="row" action="{{route('calculos.excel')}}" method="post">
                      @csrf

                        <input style='display: none' class='form-control' type="text" name="usuario" value="{{@$dataForm['usuario']}}" placeholder="Nome do Usuário">
                        <input style='display: none' class='form-control' type="text" name="empresa" value="{{@$dataForm['empresa']}}" placeholder="Nome da Empresa">
                        <input style='display: none' class='form-control'  type="date" name="inicio" value="{{@$dataForm['inicio']}}" placeholder="">
                        <input style='display: none' class='form-control'  type="date" name="fim" value="{{@$dataForm['fim']}}" placeholder="">

                      <div style='display: inline !important;' class="form-group col-xs-12 col-sm-2">
                        <input class='btn btn-primary'  type="submit" name="" value="Gerar Excel">
                      </div>
                    </form>

                    <form class="row" action="{{route('calculos.index')}}" method="post">
                    @csrf
                    <div style='display: inline !important;' class="form-group col-xs-12 col-sm-2">
                      <input class='form-control' type="text" name="usuario" placeholder="Nome do Usuário">
                    </div>
                    <div style='display: inline !important;' class="form-group col-xs-12 col-sm-2">
                      <input class='form-control' type="text" name="empresa" placeholder="Nome da Empresa">
                    </div>
                    <div style='display: inline !important;' class="form-group col-xs-12 col-sm-2">
                      <label>De</label>
                      <input required class='form-control'  type="date" name="inicio" placeholder="Nome da Empresa" value="{{ $diaAnterior['diaAnterior'] }}">
                    </div>
                    <div style='display: inline !important;' class="form-group col-xs-12 col-sm-2">
                      <label>Até</label>
                      <input required class='form-control'  type="date" name="fim" placeholder="Nome da Empresa" value="{{ date('Y-m-d') }}">
                    </div>
                    <div style='display: inline !important;' class="form-group col-xs-12 col-sm-2">

                      <input class='btn btn-primary'  type="submit" name="" value="Filtrar">
                    </div>
                  </form>
                </div>
                <div class="row">
                  @if(isset($dataForm))
                    {{ $calculos->appends($dataForm)->links() }}
                  @else
                    {{ $calculos->links()}}
                  @endif
                </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                          {{ __('Proposta') }}
                      </th>
                      <th>
                          {{ __('Data') }}
                      </th>
                      <th>
                          {{ __('Compania') }}
                      </th>
                      <th>
                          {{ __('Valor do Financiamento') }}
                      </th>
                      <th>
                          {{ __('Nome do Condomínio') }}
                      </th>
                      <th class="text-right">
                        {{ __('Ações') }}
                      </th>
                    </thead>
                    <tbody>


                      @foreach($calculos as $calculo)

                          <tr>
                            <td>
                              {{ $calculo->chave }}
                            </td>
                            <td>
                              {{ $calculo->created_at }}
                            </td>
                            <td>
                              {{ $calculo->nome_da_companhia }}
                            </td>
                            <td>
                              R$ {{ $calculo->valorFinanciamento }}
                            </td>
                            <td>
                              {{ $calculo->nomeCondominio }}
                            </td>

                            <td class="td-actions text-right">
                              <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('calculos.edit', $calculo->id) }}" data-original-title="" title="">
                                <i class="fa fa-info" aria-hidden="true"></i>
                                <div class="ripple-container"></div>
                              </a>

                                  @php
                                    $rota = route("calculos.destroy", $calculo->id)
                                  @endphp

                                  <!-- <button  type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick='deletar("{{$rota}}")' >
                                      <i class="material-icons">close</i>
                                      <div class="ripple-container"></div>
                                  </button> -->
                                  <a target="_blank" href="{{route('calculos.pdfAdmin', $calculo->id)}}">
                                    <button  type="button" class="btn btn-danger btn-link" data-original-title="" title="" >
                                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                        <div class="ripple-container"></div>
                                    </button>
                                  </a>





                            </td>
                          </tr>

                      @endforeach
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
