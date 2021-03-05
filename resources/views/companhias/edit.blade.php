@extends('layouts.app', ['activePage' => 'company-management', 'titlePage' => __('Gerenciamento de Condição')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('companhias.update', $companhia) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Editar Companhia') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('companhias.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar para a lista') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('ID') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('id') ? ' has-danger' : '' }}">
                      {{$companhia->id}}
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nome') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" name="nome" id="input-name" type="text" placeholder="{{ __('Nome') }}" value="{{ old('nome', $companhia->nome) }}" required="true" aria-required="true"/>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Cadastro') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('cadastro') ? ' has-danger' : '' }}">
                      <input class="cnpj form-control{{ $errors->has('cadastro') ? ' is-invalid' : '' }}" name="cadastro" id="input-name" type="text" placeholder="{{ __('Cadastro') }}" value="{{ old('cadastro', $companhia->cadastro) }}" required="true" aria-required="true"/>

                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Ativo') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('dataStatus') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('dataStatus') ? ' is-invalid' : '' }}" name="dataStatus" id="input-name" type="date" placeholder="{{ __('Ativo') }}" value="{{ old('dataStatus', $companhia->dataStatus) }}" required="true" aria-required="true"/>
                      <!-- <input type="date" class='form-control' name="dataStatus" value="{{$companhia->dataStatus}}" required> -->
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Endereço') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('endereco') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('endereco') ? ' is-invalid' : '' }}" name="endereco" id="input-name" type="text" placeholder="{{ __('Endereço') }}" value="{{ old('endereco', $companhia->endereco) }}" required="true" aria-required="true"/>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Site') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('site') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('site') ? ' is-invalid' : '' }}" name="site" id="input-name" type="text" placeholder="{{ __('Site') }}" value="{{ old('site', $companhia->site) }}" required="true" aria-required="true"/>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-name" type="email" placeholder="{{ __('Email') }}" value="{{ old('email', $companhia->email) }}" required="true" aria-required="true"/>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Telefone') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('telefone') ? ' has-danger' : '' }}">
                      <input class="telefone form-control{{ $errors->has('telefone') ? ' is-invalid' : '' }}" name="telefone" id="input-name" type="text" placeholder="{{ __('Telefone') }}" value="{{ old('telefone', $companhia->telefone) }}" required="true" aria-required="true"/>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nome Contato') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('nomeContato') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('nomeContato') ? ' is-invalid' : '' }}" name="nomeContato" id="input-name" type="text" placeholder="{{ __('Nome Contato') }}" value="{{ old('nomeContato', $companhia->nomeContato) }}" required="true" aria-required="true"/>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Grupo') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('grupo') ? ' has-danger' : '' }}">
                      <select class="form-control" name="grupo_id">
                        <option value="{{$grupoAt->id}}">{{$grupoAt->nome}}</option>
                        @foreach($grupos as $grupo)
                          @if($grupo->id != $grupoAt->id)
                            <option value="{{$grupo->id}}">{{$grupo->nome}}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>

              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
