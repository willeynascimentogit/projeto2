
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
    body, html{
      margin: 0 !important;
      font-family: Arial, Helvetica, sans-serif;
    }
      .imagem{
        width: 50%;
        margin-top: -50px;
      }

      .content{
        margin: 40px !important;
      }
      .tabela{
        /* background: blue; */
      }
      </style>
  </head>
  <body>




    <header style="text-align: center; width: 100%;">
      <div style='width: 100%; position: absolute; z-index: -1; margin-top: 60px; height: 2px; background: '>

      </div>


      <!-- <img style='width:15%' class='imagem' src="{{$dados['logo']}}">
      <img style='position: absolute; float: right; width: 10%' class='' src="{{$dados['logo2']}}"> -->
      <img style='margin-top: -40px;' src="{{$dados['topo']}}" alt="">

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
.text-cab{
  margin: -bottom: 15px;
}
.tabela{
  display: block;
  margin: auto;

  text-align: center;
  width: 400px;
}
.td, .th{
  text-align: center;
  min-width: 200px !important;
}
.td{
  margin-left: 28px;
  margin-right: 60px;
}
.th{
  margin-left: 40px;
  margin-right: 40px;
}
      </style>
    <img style='float: right; margin-top: -50px; margin-right: 80px; width: 150px; position: absolute;' src="{{$dados['cyrela']}}" alt="">
    <p style="font-size: 14px; width: 100%; margin: ; background: ;">
    <span class='text-cab'>
      @if(strcmp($dados['nomeSindico'], '') != 0 and strcmp($dados['nomeCondominio'], '') != 0)
        Aos cuidados do Síndico(a) {{$dados['nomeSindico']}}  do condomínio {{$dados['nomeCondominio']}}<br>
      @elseif(strcmp($dados['nomeSindico'], '') != 0)
        Aos cuidados do Síndico(a): {{$dados['nomeSindico']}} <br>
      @elseif(strcmp($dados['nomeCondominio'], '') != 0)
        Condomínio: {{$dados['nomeCondominio']}} <br>
      @else
        <br>
      @endif
      <!-- Aos cuidados do Síndico(a) {{$dados['nomeSindico']}} <br> -->

    </span>
    <span class='text-cab'>
      Simulação de crédito de : <span style='color: #328ec3'>R$ {{$dados['valorFinanciamento']}} </span><br>
    </span>
    <span class='text-cab'>
      Data da simulação: {{ $dados['emissao'][0] }} <br>
    </span>
    <span class='text-cab'>
      Primeiro vencimento: {{$dados['diasPrimeiroVenc'][0]}} dias<br>
    </span>
    <span class='text-cab'>
      @if($dados['parcelaFixa'])
        Correção: Pré-Fixado (Parcelas Fixas). <br>
      @else
        Correção: Pós-Fixado (Parcelas + IPCA) <br>
      @endif
    </span><br><br>
    <!-- <span class='text-cab' style='text-align: justify; background:;'>
      A simulação é do valor líquido a ser creditado.
    </span><br>
    <span class='text-cab' style='text-align: justify; background:;'>
       Valores apresentados e aprovação sujeito a análise de crédito<br>
    </span> -->


    <!-- <p style='text-align: center;'>
        <ul  style="font-size: 14px; background: ; width: 100%; margin: ;">
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
            Operação realizada por instituição financeira autorizada pelo Banco Central (Resolução No 3.954)
          </li>
        </ul>
      </p> -->

    <p style="font-size: 14px; width: 100%; margin: ; background: ;">

    </p>
  </p><br>

    <p style='text-align: center; font-size: 15px;'>
      <!-- <span style='color: blue; font-weight: bold;'>R$ {{$dados['valorFinanciamento']}}</span><br><br> -->

      <span style='width: 500px; margin: auto; height: 145px !important; display: block; '>

         <div class="tabela">


          <strong class='th' style=''>Prazo</strong>
          <strong class='th' style=''>Valor da Parcela</strong><br><br>



        @for($i=0; $i<count($dados['prazo']); $i++)


            <span class='td' style=''>{{$dados['prazo'][$i]}} Meses</span>
            <span class='td' style=''>R$ {{$dados['parcela'][$i]}}</span><br>



        @endfor
      </div>


      </span><br><br><br><br>


      <span style='font-size: 7px; font-family: Arial, Helvetica, sans-serif;'>
        A simulação é do valor líquido a ser creditado.<br>
        Valores apresentados e aprovação sujeito a análise de crédito<br>
        <!-- @if($dados['parcelaFixa'])
          Correção: Pré-Fixado (Parcelas Fixas). <br>
        @else
          Correção: Pós-Fixado (Parcelas + IPCA) <br>
        @endif -->

        <!-- Primeira parcela com vencimento para {{$dados['diasPrimeiroVenc'][0]}} dias.<br> -->
        Todas as taxas e impostos incluídos nas parcelas. Não exigimos garantia ou fiador. Primeira parcela para {{$dados['diasPrimeiroVenc'][0]}} dias.<br>
        <strong style='background: yellow'>A aprovação do crédito deve constar na pauta da assembleia e aprovado para liberação dos recursos.</strong><br>
        Simulação válida por 15 dias.

      </span>
    </p>
    <h5 style='text-align: center; width: 200px; margin: auto; margin-top: 10px;'>Proposta: {{$dados['chave']}}</h5>
    <!-- <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> -->
    <br><br><br><br><br><br>
    <span style='font-family: Arial, Helvetica, sans-serif; font-size: 10px;' >
      Agradecemos o contato e estamos à disposição.<br>
      Equipe CashMe Condo<br>

    </span>
  </div>

    <img style='width: 100%; margin-top: 940px; position: fixed;' class='imagem' src="{{$dados['rodape']}}">

</body>
</html>
