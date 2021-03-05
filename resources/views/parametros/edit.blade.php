@extends('layouts.app', ['activePage' => 'par-management', 'titlePage' => __('Gerenciamento de Parâmetros')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('parametros.update', $parametros) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Editar Parâmetros') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
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
                  <div class="col-md-12 text-right">
                      <!-- <a href="{{ route('produtos.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar para a lista') }}</a> -->
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Comissão Instituição') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('comissaoInst') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('comissaoInst') ? ' is-invalid' : '' }}" name="comissaoInst" id="input-comissaoInst" type="number" step="any" placeholder="{{ __('Comissão Instituição') }}" value="{{ old('comissaoInst', $parametros->comissaoInst) }}" required="true" aria-required="true"/>
                      @if ($errors->has('comissaoInst'))
                        <span id="comissaoInst-error" class="error text-danger" for="input-name">{{ $errors->first('comissaoInst') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Comissão Sobre Parceiro') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('sobreParceiro') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('sobreParceiro') ? ' is-invalid' : '' }}" name="sobreParceiro" id="input-sobreParceiro" type="number" step="any" placeholder="{{ __('Sobre Parceiro') }}" value="{{ old('sobreParceiro', $parametros->sobreParceiro) }}" required="true" aria-required="true"/>
                      @if ($errors->has('sobreParceiro'))
                        <span id="sobreParceiro-error" class="error text-danger" for="input-name">{{ $errors->first('sobreParceiro') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Valor Instituição') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('valorInstituicao') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('valorInstituicao') ? ' is-invalid' : '' }}" name="valorInstituicao" id="input-valorInstituicao" type="number" step="any" placeholder="{{ __('Valro Instituição') }}" value="{{ old('valorInstituicao', $parametros->valorInstituicao) }}" required="true" aria-required="true"/>
                      @if ($errors->has('valorInstituicao'))
                        <span id="valorInstituicao-error" class="error text-danger" for="input-name">{{ $errors->first('valorInstituicao') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('IOF Adicional') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('iofAdicional') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('iofAdicional') ? ' is-invalid' : '' }}" name="iofAdicional" id="input-iofAdicional" type="number" step="any" placeholder="{{ __('IOF Adicional') }}" value="{{ old('iofAdicional', $parametros->iofAdicional) }}" required="true" aria-required="true"/>
                      @if ($errors->has('iofAdicional'))
                        <span id="iofAdicional-error" class="error text-danger" for="input-iofAdicional">{{ $errors->first('iofAdicional') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('IOF Diário') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('iofDiario') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('iofDiario') ? ' is-invalid' : '' }}" name="iofDiario" id="input-iofDiario" type="number" step="any" placeholder="{{ __('IOF Diário') }}" value="{{ old('iofDiario', $parametros->iofDiario) }}" required="true" aria-required="true"/>
                      @if ($errors->has('iofDiario'))
                        <span id="iofDiario-error" class="error text-danger" for="input-iofDiario">{{ $errors->first('iofDiario') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('IOF Fixo') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('iofFixo') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('iofFixo') ? ' is-invalid' : '' }}" name="iofFixo" id="input-iofFixo" type="number" step="any" placeholder="{{ __('IOF Fixo') }}" value="{{ old('iofFixo', $parametros->iofFixo) }}" required="true" aria-required="true"/>
                      @if ($errors->has('iofFixo'))
                        <span id="iofFixo-error" class="error text-danger" for="input-iofFixo">{{ $errors->first('iofFixo') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Custo TED') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('custoTed') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('custoTed') ? ' is-invalid' : '' }}" name="custoTed" id="input-custoTed" type="number" step="any" placeholder="{{ __('Custo TED') }}" value="{{ old('custoTed', $parametros->custoTed) }}" required="true" aria-required="true"/>
                      @if ($errors->has('custoTed'))
                        <span id="custoTed-error" class="error text-danger" for="input-custoTed">{{ $errors->first('custoTed') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Custo Boleto') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('custoBoleto') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('custoBoleto') ? ' is-invalid' : '' }}" name="custoBoleto" id="input-custoBoleto" type="number" step="any" placeholder="{{ __('Custo Boleto') }}" value="{{ old('custoBoleto', $parametros->custoBoleto) }}" required="true" aria-required="true"/>
                      @if ($errors->has('custoBoleto'))
                        <span id="custoTed-error" class="error text-danger" for="input-custoTed">{{ $errors->first('custoBoleto') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                <script type="text/javascript">
                  var prazos=0;
                </script>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Prazos:') }}</label>
                  <div class="col-sm-7">
                    <div class="">
                      <span onclick="adicionarPrazo()" class='btn btn-success'>+ prazo</span>
                    </div>
                    @php
                      $i = 0
                    @endphp
                    <div  id="contem-prazo">
                    @foreach($prazos as $p)
                      <div class="row" id="prazo{{$i}}">
                        <div class="col-sm-3">
                          {{$p->prazo}} meses
                        </div>
                        <input type="hidden" name="prazo[]" value="{{$p->prazo}}">
                        <div class="col-sm-1">
                          <i onclick='removerPrazo({{$i}})' style='color: red; cursor: pointer;' class='fa fa-trash'></i>
                        </div>
                      </div>
                      @php
                        $i = $i + 1
                      @endphp
                      <script type="text/javascript">
                        prazos++;
                      </script>
                    @endforeach
                  </div>
                  </div>
                </div>
                <script type="text/javascript">
                  function adicionarPrazo() {
                    $("#contem-prazo").append("<div class='row' id='prazo"+prazos+"'><div class='col-sm-3'><input required class='form-control' name='prazo[]' type='number' min='0' max='100'/></div><i onclick='removerPrazo("+prazos+")' style='color: red; cursor: pointer;' class='fa fa-trash'></i></div>");
                  }
                  function removerPrazo(prazos) {
                    $("#prazo"+prazos).remove();
                  }
                </script>

                <script type="text/javascript">
                  var vencimentos=0;
                </script>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Vencimentos:') }}</label>
                  <div class="col-sm-7">
                    <div class="">
                      <span onclick="adicionarVencimento()" class='btn btn-success'>+ vencimento</span>
                    </div>
                    @php
                      $j = 0
                    @endphp
                    <div  id="contem-vencimento">
                      <div class="row" id="">
                        <div class="col-sm-3">
                          <!-- 30 dias -->
                        </div>
                        <!-- <input type="hidden" name="vencimento[]" value="30"> -->

                      </div>
                    @foreach($vencimentos as $v)
                      <div class="row" id="vencimento{{$j}}">
                        <div class="col-sm-3">
                          {{$v->vencimento}} dias
                        </div>
                        <input type="hidden" name="vencimento[]" value="{{$v->vencimento}}">
                        <div class="col-sm-1">
                          <i onclick='removerVencimento({{$j}})' style='color: red; cursor: pointer;' class='fa fa-trash'></i>
                        </div>
                      </div>
                      @php
                        $j = $j + 1
                      @endphp
                      <script type="text/javascript">
                        prazos++;
                      </script>
                    @endforeach
                  </div>
                  </div>
                </div>
                <script type="text/javascript">
                  function adicionarVencimento() {
                    $("#contem-vencimento").append("<div class='row' id='vencimento"+vencimentos+"'><div class='col-sm-3'><input required class='form-control' name='vencimento[]' type='number' min='0' max='1000'/></div><i onclick='removerVencimento("+vencimentos+")' style='color: red; cursor: pointer;' class='fa fa-trash'></i></div>");
                  }
                  function removerVencimento(vencimentos) {
                    $("#vencimento"+vencimentos).remove();
                  }
                </script>

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
