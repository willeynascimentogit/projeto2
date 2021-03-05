<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('parametros')->insert([
          'comissaoInst' => 2,
          'custoTed' => 27.00,
          'custoBoleto' => 10.2,
          'iofDiario' => 0.0041,
          'iofAdicional' => 0.38,
          'created_at' => now(),
          'updated_at' => now()

      ]);

      DB::table('prazos')->insert([
          'prazo' => 24,
          'created_at' => now(),
          'updated_at' => now()
      ]);

      DB::table('pvencimentos')->insert([
          'vencimento' => 30,
          'created_at' => now(),
          'updated_at' => now()
      ]);


        DB::table('users')->insert([
            'name' => 'Admin Admin',
            'email' => 'admin@material.com',
            'email_verified_at' => now(),
            'nivel' => 2,
            'password' => Hash::make('abcds7on'),
            'telefone'=>'75999000999',
            'dataStatus' => date("y/m/d"),
            'dataStatus' => date("y/m/d"),
            'primeiroAcesso' => true,
            'status' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);


        DB::table('produtos')->insert([
            'nome' => 'Produto 1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('produtos')->insert([
            'nome' => 'Produto 2',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('produtos')->insert([
            'nome' => 'Produto 3',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('produtos')->insert([
            'nome' => 'Produto 4',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('produtos')->insert([
            'nome' => 'Produto 5',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        DB::table('grupos')->insert([
            'nome' => 'Grupo 1',
            'created_at' => now(),
            'updated_at' => now()
        ]);



        DB::table('condicaos')->insert([
            'id' => 1,
            'valorFinanciamento' => 10000,
            'valorFinAte' => 100000,
            'mesesMin' => 20,
            'mesesMax' => 40,
            'taxa' => 2,
            'comissaoParc' => 2,
            'comissaoConCred' => 2,
            'produto_id' => 1,
            'grupo_id' => 1
        ]);


        DB::table('companhias')->insert([
            'id' => 1,
            'nome' => 'Alpha Company',
            'cadastro' => '09877765433',
            'endereco' => 'Rua oito',
            'site' => 'www.company.com.br',
            'email' => 'alphacomp@hotmail.com',
            'telefone' => '75999000999',
            'nomeContato' => 'Alpha',
            'dataStatus' => date('yy/m/d'),
            'grupo_id' => 1

        ]);

        DB::table('users')->insert([
            'name' => 'User 1',
            'email' => 'user1@hotmail.com',
            'email_verified_at' => now(),
            'nivel' => 1,
            'password' => Hash::make('abcds7'),
            'telefone'=>'75999000991',
            'dataStatus' => date("y/m/d"),
            'dataStatus' => date("y/m/d"),
            'primeiroAcesso' => true,
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'companhia_id' => 1
        ]);







    }
}
