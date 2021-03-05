<?php

namespace App\Exports;

use App\Calculo;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;



class CalculosExport implements FromArray, ShouldAutoSize, WithHeadings
{
    protected $calculos;

    public function headings(): array
    {
        return [
          'ID',
          'Síndico',
          'ID da Proposta',
          'Condomínio',
          'CNPJ',
          'Prazo',
          'Emissão',
          'Primeiro vencimento',
          'Comissão da Instituição',
          'Custo do TED',
          'Custo do Boleto',
          'Tipo',
          'Comissão do Parceiro',
          'Comissão CondCred',
          'TAC',
          'IOF',
          'Valor do Financiamento',
          'Valor Financiado',
          'Valor Financiado Atualizado',
          'Parcela',
          'Dias para o primeiro vencimento',
          'ID do Usuário',
          'Data',
        ];
    }


    public function __construct(array $calculos)
    {
        $this->calculos = $calculos;
    }



    public function array(): array
    {
        return $this->calculos;
    }
}
