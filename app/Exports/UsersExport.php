<?php

namespace App\Exports;

use App\Calculo;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;



class UsersExport implements FromArray, ShouldAutoSize, WithHeadings
{
    protected $calculos;

    public function headings(): array
    {
        return [
          'ID',
          'Nome',
          'Email',
          'Verificação',
          'Nível',
          'Telefone',
          'Data Status',
          'Aceitou o termo',
          'Status',
          'Pode alterar parâmetros',
          'Primeiro acesso',
          'ID da companhia',
          'Criação',
          'Atualização',
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
