
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
    body, html{
      margin: 0 !important;
    }
      .imagem{
        width: 50%;
        margin-top: -50px;
      }

      .content{
        margin: 40px !important;
      }
      </style>
  </head>
  <body>




    <header style="text-align: center; width: 100%;">
      <div style='width: 100%; position: absolute; z-index: -1; margin-top: 60px; height: 2px; background: #5d9af7;'>

      </div>


      <img style='width:40%' class='imagem' src="{{$calculo->logo}}">

    </header><br>
    <div class="content">
      <style media="screen">


The below code helps you in understanding. Here's a JSFiddle demo.

li:before
{
  content: '✔';
  margin-left: -1em;
  margin-right: .100em;
}

ul
{
 padding-left: 20px;
 text-indent: 2px;
 list-style: none;
 list-style-position: outside;
}
      </style>
    <p style="font-size: 14px;">
    Aos cuidados do sr. Síndico.
        <ul  style="font-size: 14px;">
          <li>
            <img style='margin-right: 10px;' src="img/checkmark.png"/>
             Nossa solução financeira é simples, rápida e sem burocracia!
          </li>
          <li>
            <img style='margin-right: 10px;' src="img/checkmark.png"/>
            Melhores condições
          </li>
          <li>
            <img style='margin-right: 10px;' src="img/checkmark.png"/>
            Análise e aprovação de crédito rápida
          </li>
          <li>
            <img style='margin-right: 10px;' src="img/checkmark.png"/>
            100% online e descomplicado
          </li>
          <li>
            <img style='margin-right: 10px;' src="img/checkmark.png"/>
            Operação realizada por instituição financeira autorizada pelo Banco Central (Resolução No 3.954)
          </li>
        </ul>


    Segue a simulação dos valores solicitados:
  </p><br>

    <p style='text-align: center; font-size: 15px;'>
      <span style='color: blue; font-weight: bold;'>R$ {{$calculo->valorFinanciamento}}</span><br><br>

      <span style='height: 145px !important; display: block;'>

        {{$calculo->prazo}}X de R$ {{$calculo->parcela}} <br>

      </span><br><br>


      <span style='font-size: 10px; font-family: italic;'>
        A simulação é do valor líquido a ser creditado. <br>
        @if($calculo->parcelaFixa)
          Todas as taxas e impostos incluídos nas parcelas fixas. <br>
        @else
          Todas as taxas e impostos incluídos nas parcelas reajustadas pelo IPCA. <br>
        @endif
        Primeira parcela com vencimento para {{$calculo->diasPrimeiroVenc}} dias. Sujeito a análise.<br>
        <span style='background: yellow'>A aprovação do crédito/financiamento deve constar na pauta da assembleia e aprovado para liberação dos recursos.</span><br>
        Simulação realizada em {{$calculo->dataEmissao}} e válida por 15 dias.
      </span>
    </p>
    <h5 style='text-align: center; width: 200px; margin: auto; margin-top: 10px;'>Proposta: {{$calculo->chave}}</h5>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <span>
      Agradecemos o contato e estamos à disposição.<br>
      <strong>Equipe CondCred</strong> <br>
      Soluções financeiras para Condomínios<br>
    </span>
  </div>

    <!-- <img style='width: 100%; margin-top: 0px; ' class='imagem' src="{{$calculo->timbrada}}"> -->

</body>
</html>
