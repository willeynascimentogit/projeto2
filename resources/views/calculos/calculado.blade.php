@extends('layouts.app', ['activePage' => 'calculo-management', 'titlePage' => __('Resultado da simulação')])

@section('content')
  <div class="content">
    <div class="container-fluid">
    <style>
        th{
            padding-right: 30px !important;
        }
        th, td{
            width: 200px !important;
        }
        .card-footer{
          border: 0px !important;
        }
        footer{
          border: 0px !important;
        }
    </style>
      <div class="row">
        <div class="col-md-12">


          <div class="">

            <table style=' border: 0px !important;' class="">
              <strong>Nome do condomínio:</strong> {{$calc[0]['nomeCondominio']}} <br>
              <strong>Data da simulação:</strong> {{$calc[0]['dataEmissao']}} <br>
              <strong>Nome do síndico:</strong> {{$calc[0]['nomeSindico']}} <br>
              <strong>Valor solicitado:</strong> R$ {{$calc[0]['valorFinanciamento']}} <br>
              <strong>Primeiro vencimento:</strong> {{$calc[0]['diasPrimeiroVenc']}} dias <br>
              @if($calc[0]['parcelaFixa'] == 0)
                <strong>Correção:</strong> Pós-fixado (IPCA) <br><br>
              @else
                <strong>Correção:</strong> Pré-fixado <br><br>
              @endif
              <div class="">
                <small style='color: red;'>(*)Sujeito a análise. Simulação realizada em {{$calc[0]['dataEmissao']}} e válida por 15 dias.</small>
              </div>

              <thead class="">

                <th class="">
                  {{ __('Prazo ') }}
                </th>
                <th class="">
                    {{ __('Valor da Parcela ') }}
                </th>
                @if(Auth::user()->parametrizavel)
                <th>
                    {{ __('Comissão do Parceiro %') }} <span style='color: red;'>( de 0 a 2,50% )</span>
                </th>
                @endif

              </thead>
              <tbody>



              <form id="form-pdf-atualizar" class="" action="{{route('calculos.pdf')}}" method="post">
                @csrf
                @method('post')


                <input type="hidden" name="nomeSindico" value="{{$calc[0]['nomeSindico']}}">
                <input type="hidden" name="nomeCondominio" value="{{$calc[0]['nomeCondominio']}}">
                <input type="hidden" name="cnpjCondominio" value="{{$calc[0]['cnpjCondominio']}}">
                <input type="hidden" name="chave" value="{{$calc[0]['chave']}}">
                @foreach($calc as $c)

                    <tr>
                      <td class="">
                        {{ $c['prazo'] }} meses
                      </td>
                      <td class="">
                        R$ {{ $c['parcela'] }}
                      </td>

                      <td class="">
                        @if(Auth::user()->parametrizavel)
                        <!-- <input class='comissao' name="comissao[]" type="number" value=""  required /> -->
                        <input id='comissao'  minlength="1" maxlength="4" onKeyUp="mascaraMoeda(this, event); max();" class="money" name="comissao[]"  type="text" placeholder="Comissão" value="{{$c['txComissaoParc']}}" required="true"/>
                        @endif


                        <script>
                          String.prototype.reverse = function(){
                            return this.split('').reverse().join('');
                          };

                          function mascaraMoeda(campo,evento){
                            var tecla = (!evento) ? window.event.keyCode : evento.which;
                            var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
                            var resultado  = "";
                            var mascara = "##.###.###.##".reverse();
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

                          function max(){
                            alert('oi');
                          }
                        </script>


                      </td>



                            <input type="hidden" name="valorFinanciamento[]" value="{{$c['valorFinanciamento']}}">
                            <input type="hidden" name="prazo[]" value="{{$c['prazo']}}">
                            <input type="hidden" name="parcela[]" value="{{$c['parcela']}}">
                            <input type="hidden" name="diasPrimeiroVenc[]" value="{{$c['diasPrimeiroVenc']}}">
                            <input type="hidden" name="emissao[]" value="{{$c['dataEmissao'] }}">
                            <input type="hidden" name="tipoFinanciamento[]" value="{{$c['tipoFinanciamento'] }}">
                            <input type="hidden" name="parcelaFixa[]" value="{{$c['parcelaFixa'] }}">
                            <input type="hidden" name="numTipoFinanciamento[]" value="{{@$c['numTipoFinanciamento'] }}">
                            <!-- <input type="submit" class="btn btn-primary" value='PDF'> -->


                    </tr>

                @endforeach
              </form>
              </tbody>
            </table>

          </div>
          <form method="post" action="{{ route('calculos.store') }}" autocomplete="on" class="form-horizontal">
            @csrf
            @method('post')



            <div class="card-footer ml-auto mr-auto">
              <a href="javascript:history.go(-1)">
                <span class="btn btn-primary">{{ __('Voltar') }}</span>
              </a>


              <a href="{{route('calculos.create')}}">
                <span class="btn btn-primary">{{ __('Nova Simulação') }}</span>
              </a>


              <span onclick="enviarForm('pdf')" class="btn btn-primary">{{ __('IMPRIMIR pdf') }}</span>
              @if(Auth::user()->parametrizavel)
                <span onclick="enviarForm('atualizar')" class="btn btn-primary">{{ __('Atualizar') }}</span>
              @endif

              <script type="text/javascript">
                function enviarForm(tipo_form){
                  if(tipo_form == 'atualizar'){
                      document.getElementById("form-pdf-atualizar").action = "{{ route('calculos.confirm') }}"
                  }
                  if(tipo_form == 'pdf'){
                      document.getElementById("form-pdf-atualizar").action = "{{ route('calculos.pdf') }}"
                  }

                  document.getElementById("form-pdf-atualizar").submit();

                }
              </script>



            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
