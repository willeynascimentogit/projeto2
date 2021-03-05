@extends('layouts.app', ['activePage' => 'group-management', 'titlePage' => __('Gerenciamento de Grupo')])

@section('content')
  <div class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('grupos.update', $grupo) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Editar Grupo') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('grupos.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar para a lista') }}</a>
                  </div>

                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nome') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" name="nome" id="input-name" type="text" placeholder="{{ __('Nome') }}" value="{{ old('nome', $grupo->nome) }}" required="true" aria-required="true"/>
                      @if ($errors->has('nome'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('nome') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
                  </div>
                </div>
              </div>
            </form>
        </div>
    </div>
  </div>
  <div class="row">
      <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-header card-header-primary">
            <h4 class="card-title">{{ __('Editar Condições') }}</h4>
            <p class="card-category"></p>
          </div>

        </div>
        <div class="card-body">
          <div class="col-12 text-right">
            <a href="{{ route('condicaos.create', $grupo->id) }}" class="btn btn-sm btn-primary">  {{ __('Nova Condição   ') }}</a>
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
