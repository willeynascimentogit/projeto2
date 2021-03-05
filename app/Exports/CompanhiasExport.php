<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;



class CompanhiasExport implements FromArray, ShouldAutoSize, WithHeadings
{
    protected $calculos;

    public function headings(): array
    {
        return [
          'ID',
          'Nome',
          'Cadastro',
          'Endereço',
          'Site',
          'Email',
          'Telefone',
          'Nome de contato',
          'Data Status',
          'ID do grupo',
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
