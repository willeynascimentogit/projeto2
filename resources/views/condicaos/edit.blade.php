@extends('layouts.app', ['activePage' => 'group-management', 'titlePage' => __('Gerenciamento de Condição')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('condicaos.update', $condicao) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Editar Condição') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('grupos.edit', $condicao->grupo_id) }}" class="btn btn-sm btn-primary">{{ __('Voltar para o grupo') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Valor do Financiamento') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('valorFinanciamento') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('valorFinanciamento') ? ' is-invalid' : '' }}" name="valorFinanciamento" id="input-name" type="text" placeholder="{{ __('Valor do Financiamento') }}" value="{{ old('valorFinanciamento', $condicao->valorFinanciamento) }}" required="true" aria-required="true"/>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Valor do Financiamento Até') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('valorFinAte') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" name="valorFinAte" id="input-name" type="text" placeholder="{{ __('Valor do financiamento até') }}" value="{{ old('valorFinAte', $condicao->valorFinAte) }}" required="true" aria-required="true"/>

                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Mínimo de meses') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('mesesMin') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('mesesMin') ? ' is-invalid' : '' }}" name="mesesMin" id="input-name" type="text" placeholder="{{ __('Mínimo de Meses') }}" value="{{ old('mesesMin', $condicao->mesesMin) }}" required="true" aria-required="true"/>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Máximo de meses') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('mesesMax') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('mesesMax') ? ' is-invalid' : '' }}" name="mesesMax" id="input-name" type="text" placeholder="{{ __('Máximo de Meses') }}" value="{{ old('mesesMax', $condicao->mesesMax) }}" required="true" aria-required="true"/>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Taxa') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('taxa') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('taxa') ? ' is-invalid' : '' }}" name="taxa" id="input-name" type="text" placeholder="{{ __('Taxa') }}" value="{{ old('taxa', $condicao->taxa) }}" required="true" aria-required="true"/>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Comissão do parceiro') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('comissaoParc') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('comissaoParc') ? ' is-invalid' : '' }}" name="comissaoParc" id="input-name" type="text" placeholder="{{ __('Comissão do parceiro') }}" value="{{ old('comissaoParc', $condicao->comissaoParc) }}" required="true" aria-required="true"/>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Comisão ConCred') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('comissaoConCred') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('comissaoConCred') ? ' is-invalid' : '' }}" name="comissaoConCred" id="input-name" type="text" placeholder="{{ __('Comissao ConCred') }}" value="{{ old('comissaoConCred', $condicao->comissaoConCred) }}" required="true" aria-required="true"/>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Produto') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('comissaoConCred') ? ' has-danger' : '' }}">
                      <select class="form-control" name="produto_id">
                        <option value="{{$produtoSelecionado->id}}">{{$produtoSelecionado->nome}}</option>
                        @foreach($produtos as $produto)
                          <option value="{{$produto->id}}">{{$produto->nome}}</option>
                        @endforeach

                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Parâmetro') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('comissaoConCred') ? ' has-danger' : '' }}">
                      <select class="form-control" name="parametro_id">
                        <option value="{{$parametroSelecionado->id}}">{{$parametroSelecionado->id}}</option>
                        @foreach($parametros as $parametro)
                          <option value="{{$parametro->id}}">{{$parametro->id}}</option>
                        @endforeach

                      </select>
                    </div>
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
