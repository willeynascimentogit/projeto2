@extends('layouts.app', ['activePage' => 'company-management', 'titlePage' => __('Gerenciamento de Companhias')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Companhias') }}</h4>
                <p class="card-category"> {{ __('Aqui você pode gerenciar Companhias') }}</p>
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
                  <div class="col-12 text-right">
                    <form class="row" action="{{route('companhias.excel')}}" method="post">
                      @csrf

                        <!-- <input style='display: none' class='form-control' type="text" name="usuario" value="{{@$dataForm['usuario']}}" placeholder="Nome do Usuário">
                        <input style='display: none' class='form-control' type="text" name="empresa" value="{{@$dataForm['empresa']}}" placeholder="Nome da Empresa">
                        <input style='display: none' class='form-control'  type="date" name="inicio" value="{{@$dataForm['inicio']}}" placeholder="">
                        <input style='display: none' class='form-control'  type="date" name="fim" value="{{@$dataForm['fim']}}" placeholder=""> -->


                        <input class='btn btn-sm btn-primary'  type="submit" name="" value="Gerar Excel">
                        <a href="{{ route('companhias.create') }}" class="text-left btn btn-sm btn-primary">{{ __('Adicionar Companhia') }}</a>

                    </form>
                  </div>
                </div>
                <br><div class="row">

                  <div class="col-sm-12">

                    <h4>Filtro</h4>

                    <form class="row" action="{{route('companhias.index')}}" method="post">
                    @csrf
                    <div style='display: inline !important;' class="form-group col-xs-12 col-sm-2">
                      <input class='form-control' type="text" name="pesquisa" placeholder="Nome ou Email">
                    </div>
                    <div style='display: inline !important;' class="form-group col-xs-12 col-sm-2">
                      <input class='btn btn-primary'  type="submit" name="" value="Filtrar">
                    </div>
                  </form>

                </div>
                @if(isset($dataForm))
                  {{$companhias->appends($dataForm)->links()}}
                @else
                  {{$companhias->links()}}
                @endif
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                          #
                      </th>
                      <th>
                          {{ __('Nome') }}
                      </th>
                      <th>
                        {{ __('Cadastro') }}
                      </th>
                      <th>
                        {{ __('Endereço') }}
                      </th>
                      <th>
                        {{ __('Site') }}
                      </th>
                      <th>
                        {{ __('Email') }}
                      </th>
                      <th>
                        {{ __('Telefone') }}
                      </th>
                      <th>
                        {{ __('nomeContato') }}
                      </th>

                      <th>
                        {{ __('Mudança de Status') }}
                      </th>

                      <th class="text-right">
                        {{ __('Ações') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($companhias as $companhia)

                          <tr>
                            <td>
                              {{ $companhia->id }}
                            </td>
                            <td>
                             {{ $companhia->nome }}
                            </td>
                            <td>
                             {{ $companhia->cadastro }}
                            </td>
                            <td>
                              {{ $companhia->endereco }}
                            </td>
                            <td>
                              <a href="https://{{ $companhia->site }}">{{ $companhia->site }}</a>

                            </td>
                            <td>
                              {{ $companhia->email }}
                            </td>
                            <td>
                              {{ $companhia->telefone }}
                            </td>
                            <td>
                              {{ $companhia->nomeContato }}
                            </td>
                            <td>
                              {{ $companhia->dataStatus }}
                            </td>
                            <td class="td-actions text-right">

                                <form action="{{ route('companhias.destroy', $companhia->companhia) }}" method="post">
                                    @csrf
                                    @method('delete')

                                    <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('companhias.edit', $companhia->companhia) }}" data-original-title="" title="">
                                      <i class="material-icons">edit</i>
                                      <div class="ripple-container"></div>
                                    </a>
                                    @php
                                      $rota = route("companhias.destroy", $companhia->companhia)
                                    @endphp

                                    <button  type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick='deletar("{{$rota}}")' >
                                        <i class="material-icons">close</i>
                                        <div class="ripple-container"></div>
                                    </button>
                                </form>
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
