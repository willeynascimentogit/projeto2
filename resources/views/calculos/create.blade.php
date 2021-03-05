@extends('layouts.app', ['activePage' => 'calculo-management', 'titlePage' => __('Simulador')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('calculos.confirm') }}" autocomplete="on" class="form-horizontal">
            @csrf
            @method('post')

            <input type="hidden" name="nivel" value="1">

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Nova Simulação') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">

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
                <div class="col-md-12 text-left">
                    <!-- <a href="{{ route('calculos.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar para a lista') }}</a> -->
                    <small style='color: red;'>Atenção: Campos com *  são obrigatórios.</small>
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
                  <label class="col-sm-2 col-form-label">{{ __('Nome do condomínio') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('nomeCondominio') ? ' has-danger' : '' }}">
                    </div>
                    <input class="form-control{{ $errors->has('nomeCondominio') ? ' is-invalid' : '' }}" name="nomeCondominio" id="input-nomeCondominio" type="text" placeholder="{{ __('Nome do condomínio') }}" value="{{ old('nomeCondominio') }}" />
                  </div>
                </div>
                <div class="row">
                  <!-- <label class="col-sm-2 col-form-label">{{ __('CNPJ do condomínio') }}</label> -->
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('cnpjCondominio') ? ' has-danger' : '' }}">
                    </div>
                    <input style='display: none !important;' class="cnpj form-control{{ $errors->has('cnpjCondominio') ? ' is-invalid' : '' }}" name="cnpjCondominio" id="input-cnpjCondominio" type="text" placeholder="{{ __('CNPJ do condomínio') }}" value="{{ old('cnpjCondominio') }}" />
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nome do síndico') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('nomeSindico') ? ' has-danger' : '' }}">
                    </div>
                    <input class="form-control{{ $errors->has('nomeSindico') ? ' is-invalid' : '' }}" name="nomeSindico" id="input-nomeSindico" type="text" placeholder="{{ __('Nome do síndico') }}" value="{{ old('nomeSindico') }}"  aria-required="false"/>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('1º Vencimento*') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('diasPrimeiroVenc') ? ' has-danger' : '' }}">
                      <select class="form-control" name="diasPrimeiroVenc">
                        @foreach($vencimentos as $v)
                          <option value="{{$v->vencimento}}">{{$v->vencimento}} dias</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Valor do Crédito*') }}</label>

                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('valorFinanciamento') ? ' has-danger' : '' }}">
                      <input minlength="4" id="value" onKeyUp="mascaraMoeda(this, event)" class="money form-control{{ $errors->has('valorFinanciamento') ? ' is-invalid' : '' }}" name="valorFinanciamento" id="input-valorFinanciamento" type="text" placeholder="{{ __('Valor do Financiamento') }}" value="{{ old('valorFinanciamento') }}" required="true" aria-required="true"/>
                    </div>
                  </div>
                  <script>
                    String.prototype.reverse = function(){
                      return this.split('').reverse().join('');
                    };

                    function mascaraMoeda(campo,evento){
                      var tecla = (!evento) ? window.event.keyCode : evento.which;
                      var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
                      var resultado  = "";
                      var mascara = "##.###.###,##".reverse();
                      for (var x=0, y=0; x<mascara.length && y<valor.length;) {
                        if (mascara.charAt(x) != '#') {
                          resultado += mascara.charAt(x);
                          x++;
                        } else {
                          resultado += valor.charAt(y);
                          y++;
                          x++;
                        }
                      }
                      campo.value = resultado.reverse();
                    }
                  </script>



                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Prazo do Crédito*') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('prazo') ? ' has-danger' : '' }}">
                      <div>
                        <!-- <input style='margin-left: 4px;' onclick="habCheck()" type="radio" name="hab" value=""><label style='margin-left: 4px;'>Definido</label><br> -->
                        <label style='margin-left: 4px;'>

                        @foreach($prazos as $p)
                          <br><input checked onclick="habCheck()" style='margin-left: 5px;' class='prazoCheck' type="checkbox" name="prazo[]" value="{{$p->prazo}}"><label style='margin-left: 2px;'>{{$p->prazo}} meses</label>
                        @endforeach

                      </div>
                      <!-- <input style='margin-left: 4px;' onclick="" type="radio" name="prazo[]" value=""> -->
                       <label style='margin-left: 4px;'>Outro: </label><input  style='margin-left: 5px;' id="prazoRadio"  type="number" min="6" class='' max="100" name="prazo[]" value="">
                    </div>
                  </div>
                </div>
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
                  <label class="col-sm-2 col-form-label">{{ __('Tipo de Crédito*') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('tipoFinanciamento') ? ' has-danger' : '' }}">
                      <select class="form-control" name="tipoFinanciamento">
                        @foreach($produtos as $produto)
                          <option value="{{$produto->id}}">{{$produto->nome}}</option>
                        @endforeach
                      </select>
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

                <div class="row">
                  <!-- <label class="col-sm-2 col-form-label">{{ __('Comissão do parceiro %') }}</label> -->
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('comissao') ? ' has-danger' : '' }}">
                      <input style='display: none' onkeyup="valorCom()" class="form-control{{ $errors->has('comissao') ? ' is-invalid' : '' }}" name="comissao[]" id="input-comissao" type="text" placeholder="{{ __('Comissão') }}" value="0"  aria-required="true"/>
                      <input type="hidden" name="primeiraSimulacao" value="true">
                    </div>
                  </div>
                </div>



              <div class="card-footer ml-auto mr-auto">
                <div class="col-sm-5" style='margin: auto'>
                  <button style='display: inline;' type="submit" class="btn btn-primary">{{ __('Simular') }}</button>
                  <button style='display: inline;' type="reset" class="btn btn-primary">{{ __('Nova Simulação') }}</button>
                </div>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
