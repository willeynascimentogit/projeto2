<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Pagination;
use App\Exports\CalculosExport;
use Maatwebsite\Excel\Facades\Excel;

use Auth;
use DateTime;
use App\Finance;
use App\User;
use App\Companhia;
use App\Grupo;
use App\Condicao;
use App\Produto;
use App\Calculo;
use App\Parametro;
use App\Pvencimento;
use App\Prazo;

class CalculoController extends Controller{
  public function excel(Request $req){
    $dados = $req->all();

    $resultado = Calculo::all();

    $registros = new CalculosExport([$resultado]);

    return Excel::download($registros, 'calculos.xlsx');
  }
  public function index(Request $req){
      $dados = $req->all();
      $calculos = new Collection;
      // dd($dados);
      if(isset($dados['empresa']) || isset($dados['usuario']) || isset($dados['inicio'])){
        if(!isset($dados['empresa'])){
          $dados['empresa'] = null;
        }
        if(!isset($dados['usuario'])){
          $dados['usuario'] = null;
        }
        //filtrando por user e companhia
        if($dados['usuario'] != null and $dados['empresa'] != null){
          $calculos = DB::table('calculos')
          ->join('users', 'users.id', '=', 'calculos.user_id')
          ->select('calculos.*', 'users.name as nome')
          ->join('companhias', 'companhias.id', '=', 'users.companhia_id')
          ->select('calculos.*', 'companhias.nome as companhia')
          ->where('companhias.nome', 'like', $dados['empresa']."%")
          ->where('users.name', 'like', $dados['usuario'])
          ->paginate(50);
        }//filtrando por user
        else if($dados['usuario'] != null and $dados['empresa'] == null){
          $calculos = DB::table('calculos')
          ->join('users', 'users.id', '=', 'calculos.user_id')
          ->select('calculos.*', 'users.name as nome')
          ->where('users.name', 'like', $dados['usuario'])->paginate(50);

        }
        //filtrando companhias
        else if($dados['usuario'] == null and $dados['empresa'] != null){
          $calculos = DB::table('calculos')
          ->join('users', 'users.id', '=', 'calculos.user_id')
          ->select('calculos.*', 'users.name as nome')
          ->join('companhias', 'companhias.id', '=', 'users.companhia_id')
          ->where('companhias.nome', 'like', $dados['empresa']."%")
          ->paginate(50);


          // $companhias = DB::table('companhias')->where('nome', 'like', $dados['empresa']."%")
          // ->get();
          //
          // $usuarios = new Collection();
          // foreach($companhias as $c){
          //   $result = DB::table('users')->where('companhia_id', '=', $c->id)
          //   ->get();
          //   $usuarios = $usuarios->merge($result);
          // }
          //
          // foreach($usuarios as $u){
          //   $result = DB::table('calculos')->where('user_id', '=', $u->id)
          //   ->where('data', '>=', $dados['inicio'])
          //   ->where('data', '<=', $dados['fim'])
          //   ->paginate(1);
          //   dd($result);
          //   $calculos = $calculos->merge($result);
          // }

        }
        else if($dados['usuario'] == null and $dados['empresa'] == null){
          $result = DB::table('calculos')
          ->where('data', '>=', $dados['inicio'])
          ->where('data', '<=', $dados['fim'])
          ->paginate(50);

          $calculos = $result;

        }
        $i=0;
        foreach($calculos as $c){
            $c->index = $i;
            $i++;
        }

        foreach($calculos as $c){
          if($this->repetido($calculos, $c->chave)){
            $calculos->forget($c->index);
          }
        }

        foreach($calculos as $c){
          $user = User::find($c->user_id);
          if($user != null){
            $c->nome_da_companhia = $user->companhia->nome;
           }
          else{
            $c->nome_da_companhia = "Não informada";
          }


          // $c->valorFinanciamento = number_format($c->valorFinanciamento, "2", ",", ".");
        }

        $diaAnterior['diaAnterior'] = date('Y-m-d', strtotime('-1 days'));
        $dataForm = $req->except('_token');
        // dd($dataForm);
        return view('calculos.index', compact('calculos', 'dataForm', 'diaAnterior'));
      }
      else{




        // $calculos = DB::table('calculos')->select('chave', 'id', 'user_id', 'created_at', 'valorFinanciamento', 'nomeCondominio')
        // ->distinct()->paginate(50);

        $calculos = DB::table('calculos')->paginate(50);
        // dd($calculos);
        $i=0;
        foreach($calculos as $c){
            $c->index = $i;
            $i++;
        }

        foreach($calculos as $c){
          if($this->repetido($calculos, $c->chave)){
            $calculos->forget($c->index);
          }
        }


        // dd($calculos);















        foreach($calculos as $c){
          $user = User::find($c->user_id);
          if($user != null){
      			$c->nome_da_companhia = $user->companhia->nome;
      		 }
    		  else{
    			  $c->nome_da_companhia = "Não informada";
    		  }
        // $c->valorFinanciamento = number_format($c->valorFinanciamento, "2", ",", ".");
        }
        // dd(date('Y-d-m'));
        $diaAnterior['diaAnterior'] = date('Y-m-d', strtotime('-1 days'));


        // dd($calculos);

        return view('calculos.index', compact('calculos', 'diaAnterior'));
      }
  }

  public function repetido($array, $campo){
    $registros = 0;
    foreach($array as $r){
      if(strcmp($r->chave, $campo) == 0){
        $registros++;
      }
    }

    if($registros > 1){
      return true;
    }
    return false;
  }

  public function edit($id){
    $calculo = Calculo::find($id);
    $prazos = DB::table('calculos')->where('chave', '=', $calculo->chave)->get();
    // $calculo->valorFinanciamento = number_format($calculo->valorFinanciamento, "2", ",", ".");
    return view('calculos.edit', compact('calculo', 'prazos'));
  }
  public function relatorio($id){
    $calculo = Calculo::find($id);
    return \PDF::loadView('calculos.relatorio', compact('calculo'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream('simulacao.pdf');
  }
  public function create(){


      $grupo = Grupo::find(Companhia::find(Auth::user()->companhia_id)->grupo_id);
      $condicoes = $grupo->condicoes;

      foreach($condicoes as $condicao){
        $produtos[] = Produto::find($condicao->produto_id);
        $parametro = Parametro::find($condicao->parametro_id);
      }
      $produtos = array_unique($produtos);


      $prazos = DB::table('prazos')->where('parametro_id', '=', $parametro->id)->get();
      $vencimentos = DB::table('pvencimentos')->where('parametro_id', '=', $parametro->id)->get();;


      return view('calculos.create', compact('produtos', 'parametro', 'prazos', 'condicoes', 'vencimentos'));
  }

  public function chavePDF(){
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d-m-y');
    $hora = date('H-i-s');
    $key = Auth::user()->id.$data.$hora;
    $key = str_replace("-", "", $key);
    return $key;
  }

  public function confirm(Request $request, Calculo $model){
      $info = $request->all();

      $calc = array();



        if(isset($info['primeiraSimulacao'])){
          for($i=0; $i<count($info['prazo']); $i++){
            $pos = $i + 1;
            if(isset($info['prazo'][$i]) == null){
              break;
            }
            if($this->calculoIndividual($info, $i, 0) != null){
              $calc[] = $this->calculoIndividual($info ,$i, 0);
            }

          }


        }
        else{
          $info['nivel'] = "1";
          $info['valorFinanciamento'] = $info['valorFinanciamento'][0];
          $info['diasPrimeiroVenc'] = $info['diasPrimeiroVenc'][0];
          $info['tipoFinanciamento'] = $info['numTipoFinanciamento'][0];
          if(isset($info['primeiraSimulacao'])){
            $info['primeiraSimulacao']= $info['primeiraSimulacao'];
          }
          for($i=0; $i<count($info['prazo']); $i++){
              $pos = $i + 1;

              if($this->calculoIndividual($info, $i, $i) != null){
                $calc[] = $this->calculoIndividual($info ,$i, $i);
              }

          }

        }



      if(count($calc) == 0){
        return redirect()->back()->withStatus('Sem Condições para este financiamento');
      }

      $dados = array();
      foreach($calc as $c){

        $dados['nomeSindico'][]= $c['nomeSindico'];
        $dados['nomeCondominio'][]=$c['nomeCondominio'];
        $dados['chave'][]=$this->chavePDF();
        $dados['cnpjCondominio'][]=$c['cnpjCondominio'];
        $dados['prazo'][]=$c['prazo'];
        $dados['dataEmissao'][]=$c['dataEmissao'];
        $dados['primeiroVencimento'][]=$c['primeiroVencimento'];
        $dados['comissaoInst'][]=$c['comissaoInst'];
        $dados['custoTed'][]=$c['custoTed'];
        $dados['custoBoleto'][]=$c['custoBoleto'];
        $dados['tipoFinanciamento'][]=$c['tipoFinanciamento'];
        $dados['parcelaFixa'][]=$c['parcelaFixa'];
        $dados['comissaoParc'][]=$c['comissaoParc'];
        $dados['comissaoConCred'][]=$c['comissaoConCred'];
        $dados['tac'][]=$c['tac'];
        $dados['iof'][]=$c['iof'];
        $dados['valorFinanciamento'][]=$c['valorFinanciamento'];
        $dados['valorFinanciado'][]=$c['valorFinanciado'];
        $dados['valorFinanciadoAt'][]=$c['valorFinanciadoAt'];
        $dados['parcela'][]=$c['parcela'];
        $dados['diasPrimeiroVenc'][]=$c['diasPrimeiroVenc'];
      }
      // dd($dados);
      $calculo = $this->store($dados);

      // foreach($calc as $c){
      //   $c['valorFinanciamento'] = number_format($c['valorFinanciamento'], "2", ",", ".");
      //
      // }

      $collection = collect(['first', 'second']);

      $resultado = array();
      // dd($calc);
      for($i=0; $i<count($dados['prazo']); $i++){
        $resultado[$calc[$i]['prazo']] = $calc[$i];
      }
      ksort($resultado);

      $resultadoFinal = array();
      $i=0;
      foreach($resultado as $r){
        $resultadoFinal[] = $r;
      }


      $calc = $resultadoFinal;


      // dd($calc);

      $grupo = DB::table('grupos')->where('id', '=', Auth::user()->companhia->grupo_id)->get()[0];
      $condicoes = DB::table('condicaos')->where('grupo_id', '=', $grupo->id)->get();
      $produto = Produto::find($condicoes[0]->produto_id);


      return view('calculos.calculado', compact('calc', 'produto'));


  }
  public function pdf(Request $req){
    $dados = $req->all();
    // dd($dados);
    if($dados['nomeSindico'] != null){
      $dados['nomeSindico'] = " ".$dados['nomeSindico'];
    }

    if($dados['nomeCondominio'] != null){
      $dados['nomeCondominio'] = " ".$dados['nomeCondominio'];
    }

    $dados['logo'] = public_path() ."/img/logo.png";
    $dados['topo'] = public_path() ."/img/topo.png";
    $dados['logo2'] = public_path() ."/img/logo2.png";
    $dados['cyrela'] = public_path() ."/img/cyrela.png";
    $dados['rodape'] = public_path() ."/img/rodape.png";
    $dados['valorFinanciamento'] = $dados['valorFinanciamento'][0];
    $dados['parcelaFixa'] = $dados['parcelaFixa'][0];
    $dados['emissao'][0] = $dados['emissao'][0][0].$dados['emissao'][0][1]."/".$dados['emissao'][0][3].$dados['emissao'][0][4]."/20".$dados['emissao'][0][6].$dados['emissao'][0][7];
    // dd($dados['emissao'][0]);
    $grupo = DB::table('grupos')->where('id', '=', Auth::user()->companhia->grupo_id)->get()[0];
    $condicoes = DB::table('condicaos')->where('grupo_id', '=', $grupo->id)->get();
    $produto = Produto::find($condicoes[0]->produto_id);
    return \PDF::loadView('calculos.pdf', compact('dados', 'produto'))->stream('cotacao.pdf');
    return view('calculos.pdf', compact('dados', 'produto'));
  }

  public function pdfAdmin($id){
    $calculo = Calculo::find($id);
    if($calculo->nomeSindico != null){
      $calculo->nomeSindico = " ".$calculo->nomeSindico;
    }
    if($calculo->nomeCondominio != null){
      $calculo->nomeCondominio = " ".$calculo->nomeCondominio;
    }
    $calculo->logo = public_path() ."/img/logo.png";
    $calculo->timbrada = public_path() ."/img/timbrada.png";
    // $calculo->valorFinanciamento = number_format(doubleval($calculo->valorFinanciamento), "2", ",", ".");




    return \PDF::loadView('calculos.pdfAdmin', compact('calculo'))->stream('cotacao.pdf');
    return view('calculos.pdfAdmin', compact('calculo'));
  }

  public function store($dados){

    $dados['user_id'] = Auth::user()->id;
    // dd($dados);
    for($i=0; $i<count($dados['valorFinanciamento']); $i++){
      $d['nomeSindico'] = $dados['nomeSindico'][$i];
      if($dados['nomeCondominio'][$i] == null){
        // dd($dados);
        $d['nomeCondominio'] = "Não Informado";
      }
      else{
        $d['nomeCondominio'] = $dados['nomeCondominio'][$i];
      }

      $d['chave']=$this->chavePDF();
      $d['cnpjCondominio'] = $dados['cnpjCondominio'][$i];
      $d['prazo'] = intval($dados['prazo'][$i]);
      $d['dataEmissao'] = $dados['dataEmissao'][$i];
      $d['primeiroVencimento'] = $dados['primeiroVencimento'][$i];
      $d['comissaoInst'] = $dados['comissaoInst'][$i];
      $d['custoTed'] = $dados['custoTed'][$i];
      $d['custoBoleto'] = $dados['custoBoleto'][$i];
      $d['tipoFinanciamento'] = $dados['tipoFinanciamento'][$i];
      $d['parcelaFixa'] = $dados['parcelaFixa'][$i];

      $d['comissaoParc'] = $dados['comissaoParc'][$i];
      $d['comissaoConCred'] = $dados['comissaoConCred'][$i];
      $d['tac'] = $dados['tac'][$i];
      $d['iof'] = $dados['iof'][$i];
      $d['valorFinanciamento'] = $dados['valorFinanciamento'][$i];
      $d['valorFinanciado'] = $dados['valorFinanciado'][$i];
      $d['valorFinanciadoAt'] = $dados['valorFinanciadoAt'][$i];
      $d['parcela'] = $dados['parcela'][$i];
      $d['user_id'] = $dados['user_id'];
      $d['diasPrimeiroVenc'] = intval($dados['diasPrimeiroVenc'][$i]);
      $d['data'] = date('Y-m-d');
      // dd($d);
      Calculo::create($d);
    }
    return redirect()->route('calculos.create')->withStatus('Cálculo Realizado');
  }

  public function calculoIndividual($info, $i, $j){

    $info['valorFinanciamento'] = str_replace(".", "", $info['valorFinanciamento']);
    $info['valorFinanciamento'] = str_replace(",", "", $info['valorFinanciamento']);

    // $info['valorFinanciamento'] = substr($info['valorFinanciamento'], 0, -2);
    // $info['valorFinanciamento'] = substr($info['valorFinanciamento'], 0, -2);



    // $info['valorFinanciamento'] = number_format($info['valorFinanciamento'], 0, ',', '.');
    $info['valorFinanciamento'] = doubleval($info['valorFinanciamento']);
    $info['valorFinanciamento'] = $info['valorFinanciamento'] / 100;

    // dd($info);
    $info['prazo'] = intval($info['prazo'][$i]);
    $info['tipoFinanciamento'] = intval($info['tipoFinanciamento']);
    $dados['numTipoFinanciamento'] = $info['tipoFinanciamento'];
    $info['comissao'] = floatval($info['comissao'][$j]);

    $dados['nomeSindico'] = $info['nomeSindico'];
    $dados['nomeCondominio'] = $info['nomeCondominio'];
    $dados['chave']=$this->chavePDF();
    $dados['cnpjCondominio'] = $info['cnpjCondominio'];
    $dados['prazo'] = $info['prazo'];
    $dados['valorFinanciamento'] = $info['valorFinanciamento'];

    // dd($data);
    //Dias para o primeiro vencimento
    $info['diasPrimeiroVenc'] = intval($info['diasPrimeiroVenc']);
    $dados['dataEmissao'] = date('d/m/y');
    $dados['primeiroVencimento'] = date('d/m/Y', strtotime('+'.$info['diasPrimeiroVenc'].' days'));

    $dados['diasPrimeiroVenc'] = $info['diasPrimeiroVenc'];
    $companhia_id = Auth::user()->companhia_id;

    $condicoes = Grupo::find(Companhia::find($companhia_id)->grupo_id)->condicoes;


    //BUCANDO CONDIÇÃO QUE SE ENCAIXA
    $condicao_id = 0;
    foreach($condicoes as $condicao){

      $match = 0;

      if($info['valorFinanciamento'] >= $condicao->valorFinanciamento && $info['valorFinanciamento'] <= $condicao->valorFinAte){
        $match++;


      }
      if($info['prazo'] >= $condicao->mesesMin && $info['prazo'] <= $condicao->mesesMax){
        $match++;
      }
      if($info['tipoFinanciamento'] == $condicao->produto_id){
        $match++;

      }

      if($match == 3){
        $condicao_id = $condicao->id;
      }
      else{
      }

      // dd($info);


    }


    $parametro = Parametro::find($condicao->parametro_id);
    // dd($parametro->id);
    $dados['comissaoInst'] = (($parametro->comissaoInst * $info['valorFinanciamento']) / 100)  + $parametro->valorInstituicao;
    // dd($dados['comissaoInst']);
    $dados['custoTed'] = $parametro->custoTed;
    $dados['custoBoleto'] = $dados['prazo'] * $parametro->custoBoleto;
    // dd($info);


    $dados['parcelaFixa'] = Produto::find($info['tipoFinanciamento'])->parcelaFixa;
    $dados['tipoFinanciamento'] = Produto::find($info['tipoFinanciamento'])->nome;





    //CALCULANDO TAC
    $condicao = Condicao::find($condicao_id);
    //Cancelar simulação se não houver condição
    if($condicao == null){

      return null;
    }

    // dd($info['primeiraSimulacao']);
    // dd($info['comissao']);
    if(isset($info['primeiraSimulacao'])){
      $dados['comissaoParc'] = ($condicao->comissaoParc * $info['valorFinanciamento']) / 100;
      $dados['txComissaoParc'] = $condicao->comissaoParc;
    }
    else{
      $dados['comissaoParc'] = ($info['comissao'] * $info['valorFinanciamento']) / 100;
      $dados['txComissaoParc'] = $info['comissao'];
    }

    $dados['sobreParceiro'] = ($dados['comissaoParc'] * Parametro::find($condicao->parametro_id)->sobreParceiro) / 100;
    $dados['comissaoParcOc'] = $dados['comissaoParc'] + $dados['sobreParceiro'];


    // dd($dados['txComissaoParc']);
    $dados['comissaoConCred'] = ($condicao->comissaoConCred * $info['valorFinanciamento']) / 100;
    if($parametro->id == 1){
      $dados['tac'] = $dados['custoTed'] + $dados['custoBoleto'] + $dados['comissaoInst'] + $dados['comissaoConCred'] + $dados['comissaoParcOc'];
    }
    else{
      $dados['tac'] = $dados['comissaoInst'] + $dados['comissaoConCred'] + $dados['comissaoParcOc'];
    }

    if($parametro->iofAdicional > 0 && $parametro->iofDiario > 0){
      $iof = $this->calculoIOF($info['valorFinanciamento'], $info['prazo'], $condicao->taxa, $dados['primeiroVencimento'], $dados['dataEmissao'], $condicao->parametro_id);

    }else{
    // $dados['tac'] = 5000 + $parametro->custoBoleto;
    $total = $info['valorFinanciamento'] + ($dados['tac']);

    $total = $total / (1 - $parametro->iofFixo/100) / 100;
    $total = $total * ($parametro->iofFixo);
    $iof['cobrado'] = $total;
    // $iof['cobrado'] = ($info['valorFinanciamento'] + $dados['tac']) * $parametro->iofFixo / 100;

    // echo "valor financiamento".$info['valorFinanciamento']."<br>";
    // echo "tac ".$dados['tac']."<br>";
    // echo "boleto ".$parametro->custoBoleto."<br>";
    // dd($iof['cobrado']);
    }

    $dados['iof'] = $iof['cobrado'];
    // echo "iof ".$dados['iof']."<br>";
    // echo "tac ".$dados['tac']."<br>";
    $dados['valorFinanciado'] = $dados['iof'] + $dados['tac'] + $info['valorFinanciamento'];




    $dados['iof'] = $iof['cobrado'];

    $dados['valorFinanciado'] = $dados['iof'] + $dados['tac'] + $info['valorFinanciamento'];
    // $dados['valorFinanciado'] = floatval(number_format($dados['valorFinanciado'], 5, ',', '.'));






    $vencimentos = Pvencimento::all();
    foreach($vencimentos as $v){
      if($info['diasPrimeiroVenc'] == $v->vencimento){
        if($parametro->id == 2){
          if($v->vencimento >= 60 ){

            // $dados['valorFinanciadoAt'] = $this->vf($condicao->taxa, $info['diasPrimeiroVenc']/$v->vencimento, 0, $dados['valorFinanciado'], 0);

            $dados['valorFinanciadoAt'] = $this->vf($condicao->taxa, $info['diasPrimeiroVenc']/30, 0, $dados['valorFinanciado'], 0);
            $anos = $dados['prazo'];
            $dados['parcela'] = number_format($this->calPMT($condicao->taxa, $anos, $dados['valorFinanciadoAt']), "2", ",", ".");
            $dados['parcela2'] = $this->calPMT($condicao->taxa, $anos, $dados['valorFinanciadoAt']);
            $dados['valorFinanciadoAt'] = $this->vf($condicao->taxa, $info['diasPrimeiroVenc']/30, 0, $dados['valorFinanciado'], 0);


          }
          else{
            $dados['valorFinanciadoAt'] = $this->vf($condicao->taxa, $info['diasPrimeiroVenc']/$v->vencimento, 0, $dados['valorFinanciado'], 0);
            $anos = $dados['prazo'];
            $dados['parcela'] = number_format($this->calPMT($condicao->taxa, $anos, $dados['valorFinanciado']), "2", ",", ".");
            $dados['parcela2'] = $this->calPMT($condicao->taxa, $anos, $dados['valorFinanciado']);
          }
        }
        else if($parametro->id == 1){
          if($v->vencimento >= 60 ){
            $dados['valorFinanciadoAt'] = $this->vf($condicao->taxa, $info['diasPrimeiroVenc']/60, 0, $dados['valorFinanciado'], 0);
            $anos = $dados['prazo'];
            $dados['parcela'] = number_format($this->calPMT($condicao->taxa, $anos, $dados['valorFinanciadoAt']), "2", ",", ".");
            $dados['parcela2'] = $this->calPMT($condicao->taxa, $anos, $dados['valorFinanciadoAt']);
            $dados['valorFinanciadoAt'] = $this->vf($condicao->taxa, $info['diasPrimeiroVenc']/30, 0, $dados['valorFinanciado'], 0);
          }
          else{
            $dados['valorFinanciadoAt'] = $this->vf($condicao->taxa, $info['diasPrimeiroVenc']/$v->vencimento, 0, $dados['valorFinanciado'], 0);
            $anos = $dados['prazo'];
            $dados['parcela'] = number_format($this->calPMT($condicao->taxa, $anos, $dados['valorFinanciado']), "2", ",", ".");
            $dados['parcela2'] = $this->calPMT($condicao->taxa, $anos, $dados['valorFinanciado']);
          }
        }

      }


    }

    // echo "valorFinanciadoAt ".$dados['valorFinanciadoAt']."<br>";



    if($parametro->id == 2){
      $dados['parcela'] = $dados['parcela2'] + $parametro->custoBoleto;
      $dados['parcela'] = number_format($dados['parcela'], "2", ",", ".");
    }




    // if($info['diasPrimeiroVenc'] == 30){
    //   $dados['valorFinanciadoAt'] = $this->vf($condicao->taxa, $info['diasPrimeiroVenc']/30, 0, $dados['valorFinanciado'], 0);
    //   $anos = $dados['prazo'];
    //   $dados['parcela'] = number_format($this->calPMT($condicao->taxa, $anos, $dados['valorFinanciado']), "2", ",", ".");
    // }
    // if($info['diasPrimeiroVenc'] == 60){
    //   $dados['valorFinanciadoAt'] = $this->vf($condicao->taxa, $info['diasPrimeiroVenc']/60, 0, $dados['valorFinanciado'], 0);
    //   $anos = $dados['prazo'];
    //   $dados['parcela'] = number_format($this->calPMT($condicao->taxa, $anos, $dados['valorFinanciadoAt']), "2", ",", ".");
    //
    //   $dados['valorFinanciadoAt'] = $this->vf($condicao->taxa, $info['diasPrimeiroVenc']/30, 0, $dados['valorFinanciado'], 0);
    // }
    //
    // if($info['diasPrimeiroVenc'] == 90){
    //   $dados['valorFinanciadoAt'] = $this->vf($condicao->taxa, $info['diasPrimeiroVenc']/60, 0, $dados['valorFinanciado'], 0);
    //   $anos = $dados['prazo'];
    //   $dados['parcela'] = number_format($this->calPMT($condicao->taxa, $anos, $dados['valorFinanciadoAt']), "2", ",", ".");
    //   $dados['valorFinanciadoAt'] = $this->vf($condicao->taxa, $info['diasPrimeiroVenc']/30, 0, $dados['valorFinanciado'], 0);
    // }


    $dados['valorFinanciadoAt'] = number_format($dados['valorFinanciadoAt'], "2", ",", ".");
    $dados['valorFinanciado'] = number_format($dados['valorFinanciado'], "2", ",", ".");
    $dados['custoBoleto'] = number_format($dados['custoBoleto'], "2", ",", ".");
    $dados['tac'] = number_format($dados['tac'], "2", ",", ".");
    $dados['valorFinanciamento'] = number_format($info['valorFinanciamento'], "2", ",", ".");
    // dd($dados);
    return $dados;

    // $model->create($request->all());
    // return view('calculos.calculado', compact('dados'));

  }


  public function calPMT($taxa, $prazo, $valorFinanciamento)
  {

    $rate          = $taxa/100; // 3.5% interest paid at the end of every month
    $periods       = $prazo;    // 30-year mortgage
    $present_value = - $valorFinanciamento;     // Mortgage note of $265,000.00
    $future_value  = 0;
    $beginning     = false;      // Adjust the payment to the beginning or end of the period
    $pmt           = Finance::pmt($rate, $periods, $present_value, $future_value, $beginning);

    return $pmt;
  }


  public function vf($taxa, $nper, $pgto, $vp, $tipo){


    for($i=0; $i<$nper; $i++){

        $acrescidoJuros =($vp*$taxa)/100;

        $vp = $vp + $pgto + $acrescidoJuros;
    }
    $vp = number_format($vp, 2, '.', '');
    $vp = doubleval($vp);
    return $vp;
  }

  public function calculoIOF($valorFinanciamento, $prazo, $taxa, $primeiroVenc, $dataEmissao, $parametro_id){

    $anoE = substr($dataEmissao, -2);
    $mesE = substr($dataEmissao, -5, 2);
    $diaE = substr($dataEmissao, 0, 2);
    $anoE = intval($anoE);
    $mesE = intval($mesE);
    $diaE = intval($diaE);

    $ano = substr($primeiroVenc, -4);
    $mes = substr($primeiroVenc, -7, 2);
    $dia = substr($primeiroVenc, 0, 2);
    $dia = $diaE ;
    $ano = intval($ano);
    $mes = intval($mes);
    $iof = array();


    $iof['adicional'] = Parametro::find($parametro_id)->iofAdicional;
    $iof['pmt'] = $valorFinanciamento/$prazo;
    $iof['pmt'] = number_format($iof['pmt'], 2, '.', '');
    $iof['pmt'] = doubleval($iof['pmt']);


    $iof['diario'] = Parametro::find($parametro_id)->iofDiario;
    $iof['maximo'] = (1.5*$valorFinanciamento) /100;

    $iof['acumulado'] = 0;
    $valorFinanciamentoAt = $valorFinanciamento;
    $txIOF = 0;

    $pmt = 0;

    $mes = $mesE ;
    $diasMesAnterior = cal_days_in_month(CAL_GREGORIAN, $mesE, $anoE);

    for($i=0; $i<=$prazo; $i++){


      if($i>0){
        $pmt = $valorFinanciamento/$prazo;
      }

      $valorFinanciamentoAt = $valorFinanciamentoAt - $pmt;
      $juros = ($valorFinanciamentoAt * $taxa)/100;
      // $mes = $mes;
      // $mes = $mes -1;
      $dias = 0;
      if($i > 0){
          if($mes >= 1 and $mes < 12){

            $dias = ($diasMesAnterior-$dia)+$dia;
            $diasMesAnterior = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
          }
          else if($mes == 12){
            $dias = ($diasMesAnterior-$dia)+$dia;

            $diasMesAnterior = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
          }
      }

      if($i==1){
        $txIOFnew = (30/$dias)*30*$iof['diario'];

        $txIOF = $txIOF + $txIOFnew;
        $txIOF = number_format($txIOF, 5, '.', '');

        $iofnew = ($txIOF * $pmt)/100;
        $iofnew = number_format($iofnew, 2, '.', '');
        $iof['acumulado'] = $iof['acumulado'] + $iofnew;

      }

      else if($i>=2){

        $dataE = "$anoE-$mesE-$diaE 00:00:00";
        $dataA = "$ano-$mes-$dia 00:00:00";

        $dataE = new DateTime($dataE);
        $dataA = new DateTime($dataA);


        // $txIOFnew = $dataA->diff($dataE)->days * $iof['diario'];
        // dd($dataA->diff($dataE)->days);
        $txIOF = $dataA->diff($dataE)->days * $iof['diario'];
        $txIOF = number_format($txIOF, 5, '.', '');

        $iofnew = ($txIOF * $pmt)/100;


        // dd($dataA->diff($dataE)->days);

        $iofnew = number_format($iofnew, 2, '.', '');
        $iof['acumulado'] +=   $iofnew;

        if($i == $prazo){
          // dd($iof['acumulado']);
        }
        // $iof['acumulado'] =   $iofnew;
        // dd($txIOF);


      }

      if($mesE == 12 and $i == 0){
        $ano--;
      }


        // echo " ".$mes;
        // echo " ".$i;
        // echo " ".$pmt;
        // echo " ".$valorFinanciamentoAt;
        // echo " ".$juros;
        // echo " ".$dias;?

        // echo " ".$iof['acumulado']."<br>";

        //
        // echo " ".$mes." - ";
        //  echo " ".$ano." - ";
        //  echo " - ".$txIOF;
        //
        // echo " - ".$iof['acumulado']."<br>";




        if($mes >= 1 and $mes < 12){
          $mes++;
        }
        else if($mes == 12){
          $mes = 1;
          $ano++;
          if($mesE == 12 and $mes == 12){
            $ano--;
          }
        }


    }
    $iof['adicional'] = ($iof['adicional'] * $valorFinanciamento)/ 100;
    // $iof['adicional'] = $iof['adicional'] * $prazo;

    if($iof['acumulado'] > $iof['maximo']){
      $iof['cobrado'] = $iof['maximo'] + $iof['adicional'];
    }
    else{
      $iof['cobrado'] = $iof['adicional'] + $iof['acumulado'];
    }
    // dd($iof);
    return $iof;

  }

  public function destroy($id){
    $calculo = Calculo::find($id);
    // dd($id);
    $calculo->delete();
    return redirect()->route('calculos.index');
  }
}
