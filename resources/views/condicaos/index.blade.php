@extends('layouts.app', ['activePage' => 'group-management', 'titlePage' => __('Gerenciamento de Condições')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Condições Comerciais') }}</h4>
                <p class="card-category"> {{ __('Aqui você pode gerenciar Condições') }}</p>
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
                    <a href="{{ route('condicaos.create') }}" class="btn btn-sm btn-primary">{{ __('Adicionar Condições') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                          #
                      </th>
                      <th>
                          {{ __('Valor') }}
                      </th>
                      <th>
                        {{ __('Até') }}
                      </th>
                      <th>
                        {{ __('Mín. meses') }}
                      </th>
                      <th>
                        {{ __('Máx. meses') }}
                      </th>
                      <th>
                        {{ __('Taxa') }}
                      </th>
                      <th>
                        {{ __('Com. Parceiro') }}
                      </th>
                      <th>
                        {{ __('Com. ConCred') }}
                      </th>
                      <th>
                        {{ __('Produto') }}
                      </th>
                      <th class="text-right">
                        {{ __('Ações') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($condicaos as $condicao)

                          <tr>
                            <td>
                              {{ $condicao->id }}
                            </td>
                            <td>
                              R$ {{ $condicao->valorFinanciamento }}
                            </td>
                            <td>
                              R$ {{ $condicao->valorFinAte }}
                            </td>
                            <td>
                              {{ $condicao->mesesMin }}
                            </td>
                            <td>
                              {{ $condicao->mesesMax }}
                            </td>
                            <td>
                              {{ $condicao->taxa }} %
                            </td>
                            <td>
                              {{ $condicao->comissaoParc }} %
                            </td>
                            <td>
                              {{ $condicao->comissaoConCred }} %
                            </td>
                            <td>
                              {{ $condicao->produto->nome }}
                            </td>
                            <td class="td-actions text-right">

                                <form action="{{ route('condicaos.destroy', $condicao) }}" method="post">
                                    @csrf
                                    @method('delete')

                                    <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('condicaos.edit', $condicao) }}" data-original-title="" title="">
                                      <i class="material-icons">edit</i>
                                      <div class="ripple-container"></div>
                                    </a>
                                    @php
                                      $rota = route("condicaos.destroy", $condicao)
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
