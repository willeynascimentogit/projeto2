<?php

namespace App\Http\Controllers;

use App\User;
use App\Companhia;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Auth;
use Mail;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends Controller
{
  public function excel(Request $req){
    $dados = $req->all();

    if(isset($dados['pesquisa']) and strcmp($dados['pesquisa'], '') != 0){
      $registros = DB::table('users')
      ->where('name', 'like', $dados['pesquisa']."%")
      ->orWhere('email', 'like', $dados['pesquisa']."%")
      ->paginate(15);

      $us = $registros->reject(function ($registros) {
        return $registros->nivel != 1;
      });

      $users = new Collection();
      foreach($us as $u){
        $users[] = User::find($u->id);

      }


    }
    else{
      $registros = User::all();
      $users = $registros->reject(function ($registros) {
        return $registros->nivel != 1;
      });
    }
    // dd($users);
    $registros = new UsersExport([$users]);

    return Excel::download($registros, 'usuarios.xlsx');
  }

  public function logar(Request $req){
    $dados = $req->all();

    if(Auth::attempt(['email'=>$dados['email'], 'password'=>$dados['password']])){
      if(Auth::user()->nivel == 1 && Auth::user()->primeiroAcesso == 1){
          $user = Auth::user();
          $user->primeiroAcesso = false;
          $user->save();
          return redirect()->route('profile.edit');
      }
      if(Auth::user()->nivel == 1){
        return redirect()->route('calculos.create');
      }
      if(Auth::user()->nivel == 2){
        return redirect()->route('home');
      }

    }
    else{
      return redirect()->route('login');
    }
  }
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(Request $req, User $model){
      $dados = $req->all();
      if(isset($dados['pesquisa']) and strcmp($dados['pesquisa'], '') != 0){
        $users = DB::table('users')
        ->where('nivel', '=', 1)
        ->where('name', 'like', $dados['pesquisa']."%")
        ->orWhere('email', 'like', $dados['pesquisa']."%")
        ->paginate(15);



        foreach($users as $u){
          $u->user = User::find($u->id);
        }


        $dataForm = $req->except('_token');
        return view('users.index', compact('users', 'dataForm'));

      }
      else{
        $users = DB::table('users')
        ->where('nivel', '=', 1)->paginate(15);

        foreach($users as $u){
          $u->user = User::find($u->id);
        }


        return view('users.index', compact('users'));
      }




    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $companhias = Companhia::all();
        return view('users.create', compact('companhias'));
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        $dados = $request->merge(['password' => Hash::make($request->get('password'))])->all();
        $dados['primeiroAcesso'] = true;
        $dados['companhia_id'] = $dados['companhia_id'];
        $model->create($dados);

        $GLOBALS['email'] = $dados['email'];
        $GLOBALS['senha'] = $dados['password_confirmation'];

        Mail::raw("Sua senha provisória do sistema é: ".$GLOBALS['senha'], function($m){
          $m->from('condcred@condcred.com.br', 'CondCred - Suporte');
          $m->to($GLOBALS['email']);
          $m->subject('Acesso ao sistema - CondCred');
        });

        return redirect()->route('user.index')->withStatus(__('Usuário criado com sucesso.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $companhias = Companhia::all();
        $user->companhia = Companhia::find($user->companhia_id);
        return view('users.edit', compact('user', 'companhias'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User  $user)
    {

        // dd($user);
        // $user->update(
        //     $request->merge(['password' => Hash::make($request->get('password'))])
        //         ->except([$hasPassword ? '' : 'password']
        // ));
      $dados = $request->all();
      $senha = $request->all()['senha'];

      if($senha != null and strcmp($senha, "") != 0){
        $user->password = Hash::make($senha);
        $user->save();
        User::find($dados['user_id'])->update($dados);

      }
      else{
        $user->password = $user->password;
        $user->save();
        User::find($dados['user_id'])->update($dados);
      }

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $user)
    {
        $user->status = false;
        $user->save();
        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }
}
