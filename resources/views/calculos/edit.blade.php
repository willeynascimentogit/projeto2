@extends('layouts.app', ['activePage' => 'calculo-management', 'titlePage' => __('Ver Calculo')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- <form method="post" action="{{ route('calculos.confirm') }}" autocomplete="on" class="form-horizontal"> -->
            @csrf
            @method('post')

            <input type="hidden" name="nivel" value="1">
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Cálculo') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('calculos.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar para a lista') }}</a>
                  </div>
                  @if (session('status'))

                      <div class="col-sm-12">
                        <div class="alert alert-success">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="material-icons">close</i>
                          </button>
                          <span>{{ session('status') }}</span>
                        </div>
                      </div>

                  @endif
                </div>
                <!-- <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Data da Emissão') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('dataEmissao') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('dataEmissao') ? ' is-invalid' : '' }}" name="dataEmissao" id="input-dataEmissao" type="date" placeholder="{{ __('Data da Emissão') }}" value="{{ old('dataEmissao') }}" required="true" aria-required="true"/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Valor do Financiamento') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('valorFinanciamento') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('valorFinanciamento') ? ' is-invalid' : '' }}" name="valorFinanciamento" id="input-valorFinanciamento" type="text" placeholder="{{ __('Valor do Financiamento') }}" value="{{ old('valorFinanciamento') }}" required="true" aria-required="true"/>
                    </div>
                  </div>
                </div> -->
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Chave') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      {{$calculo->chave}}
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nome do condomínio*') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('nomeCondominio') ? ' has-danger' : '' }}">
                    </div>
                    {{$calculo->nomeCondominio}}
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('CNPJ do condomínio*') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('cnpjCondominio') ? ' has-danger' : '' }}">
                    </div>
                    {{$calculo->cnpjCondominio}}
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nome do síndico') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('nomeSindico') ? ' has-danger' : '' }}">
                    </div>
                    {{$calculo->nomeSindico}}
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('1º Vencimento*') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('diasPrimeiroVenc') ? ' has-danger' : '' }}">
                      {{$calculo->diasPrimeiroVenc}} dias
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Valor do Financiamento*') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('valorFinanciamento') ? ' has-danger' : '' }}">
                      {{$calculo->valorFinanciamento}}
                    </div>
                  </div>
                </div>
                <!-- <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Prazo do Investimento*') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('prazo') ? ' has-danger' : '' }}">

                      {{$calculo->prazo}}
                    </div>
                  </div>
                </div> -->
                <script type="text/javascript">
                  // function habRadio(){
                  //   document.getElementById('prazoRadio').disabled = false;
                  //   var prazoCheck = document.getElementsByClassName('prazoCheck');
                  //   for(var i=0; i<prazoCheck.length; i++){
                  //     prazoCheck[i].disabled = true;
                  //   }
                  // }
                  // function habCheck(){
                  //   document.getElementById('prazoRadio').disabled = true;
                  //   var prazoCheck = document.getElementsByClassName('prazoCheck');
                  //   for(var i=0; i<prazoCheck.length; i++){
                  //     prazoCheck[i].disabled = false;
                  //   }
                  // }
                </script>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Tipo de Financiamentos*') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('tipoFinanciamento') ? ' has-danger' : '' }}">
                      {{$calculo->tipoFinanciamento}}
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Comissão do parceiro') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      R$ {{$calculo->comissaoParc}}
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Comissão da Instituição') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      R$ {{$calculo->comissaoInst}}
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Comissão CondCred') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      R$ {{$calculo->comissaoConCred}}
                    </div>
                  </div>
                </div>

                <script type="text/javascript">
                  function valorCom(){
                    var porc = document.getElementById("input-comissao").value;
                    var valorFinanciamento = document.getElementById("input-valorFinanciamento").value;
                    var valorComissao = (porc * valorFinanciamento)/100;

                    document.getElementById("input-valorComissao").value=valorComissao;
                  }
                </script>
<!--
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Comissão do parceiro') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('comissao') ? ' has-danger' : '' }}">
                      {{$calculo->comissaoParc}}
                    </div>
                  </div>
                </div> -->



              <div class="card-footer ml-auto mr-auto">
                <div class="col-sm-5" style='margin: auto'>

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
              <h4 class="card-title">{{ __('Prazos') }}</h4>
              <p class="card-category"></p>
            </div>

          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                      #
                  </th>
                  <th>
                      {{ __('Prazo') }}
                  </th>
                  <th>
                    {{ __('Parcela') }}
                  </th>
                  <th>
                    {{ __('Custo do Boleto') }}
                  </th>
                  <th>
                    {{ __('Tac') }}
                  </th>
                  <th>
                    {{ __('Valor Financiado') }}
                  </th>
                  <th>
                    {{ __('Valor Financiado Atualizado') }}
                  </th>
                  <th></th>

                </thead>
                <tbody>
                  @foreach($prazos as $p)

                      <tr>
                        <td>
                          {{ $p->id }}
                        </td>
                        <td>
                          {{ $p->prazo }} meses
                        </td>
                        <td>
                          R$ {{ $p->parcela }}
                        </td>
                        <td>
                          R$ {{ $p->custoBoleto }}
                        </td>
                        <td>
                          {{ $p->tac }}
                        </td>
                        <td>
                          R$ {{ $p->valorFinanciado }}
                        </td>
                        <td>
                          R$ {{ $p->valorFinanciadoAt }}
                        </td>
                        <td>
                          <a target="_blank" href="{{route('calculos.pdfAdmin', $p->id)}}">
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
@endsection
