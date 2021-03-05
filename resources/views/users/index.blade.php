@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('Gerenciamento de Usuários')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Usuários') }}</h4>
                <p class="card-category"> {{ __('Aqui você pode gerenciar usuários') }}</p>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">

                  <div class="col-sm-12 text-right">
                    <form class="row" action="{{route('users.excel')}}" method="post">
                      @csrf

                        <!-- <input style='display: none' class='form-control' type="text" name="usuario" value="{{@$dataForm['usuario']}}" placeholder="Nome do Usuário">
                        <input style='display: none' class='form-control' type="text" name="empresa" value="{{@$dataForm['empresa']}}" placeholder="Nome da Empresa">
                        <input style='display: none' class='form-control'  type="date" name="inicio" value="{{@$dataForm['inicio']}}" placeholder="">
                        <input style='display: none' class='form-control'  type="date" name="fim" value="{{@$dataForm['fim']}}" placeholder=""> -->

                        <input style='display: none' class='form-control' type="text" name="pesquisa" value="{{@$dataForm['pesquisa']}}" placeholder="Nome do Usuário">
                        <input class='btn btn-sm btn-primary'  type="submit" name="" value="Gerar Excel">
                        <a href="{{ route('user.create') }}" class="text-left btn btn-sm btn-primary">{{ __('Adicionar Usuário') }}</a>

                    </form>

                  </div>
                </div>
                <br><div class="row">

                  <div class="col-sm-12">

                    <h4>Filtro</h4>

                    <form class="row" action="{{route('users.index')}}" method="post">
                    @csrf
                    <div style='display: inline !important;' class="form-group col-xs-12 col-sm-2">
                      <input class='form-control' type="text" name="pesquisa" placeholder="Nome ou Email">
                    </div>
                    <div style='display: inline !important;' class="form-group col-xs-12 col-sm-2">
                      <input class='btn btn-primary'  type="submit" name="" value="Filtrar">
                    </div>
                  </form>

                </div>
                @if(isset($dataForm))
                  {{$users->appends($dataForm)->links()}}
                @else
                  {{$users->links()}}
                @endif
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                          {{ __('Nome') }}
                      </th>
                      <th>
                        {{ __('Email') }}
                      </th>
                      <th>
                        {{ __('Criação') }}
                      </th>
                      <th class="text-right">
                        {{ __('Ações') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($users as $user)

                          <tr>
                            <td>
                              {{ $user->name }}
                            </td>
                            <td>
                              {{ $user->email }}
                            </td>
                            <td>
                              {{ $user->user->created_at->format('Y-m-d') }}
                            </td>
                            <td class="td-actions text-right">
                              @if ($user->id != auth()->id())
                                <form action="{{ route('user.destroy', $user->user) }}" method="post">
                                    @csrf
                                    @method('delete')

                                    <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('user.edit', $user->user) }}" data-original-title="" title="">
                                      <i class="material-icons">edit</i>
                                      <div class="ripple-container"></div>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                        <i class="material-icons">close</i>
                                        <div class="ripple-container"></div>
                                    </button>
                                </form>
                              @else
                                <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('profile.edit') }}" data-original-title="" title="">
                                  <i class="material-icons">edit</i>
                                  <div class="ripple-container"></div>
                                </a>
                              @endif
                            </td>
                          </tr>

                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
