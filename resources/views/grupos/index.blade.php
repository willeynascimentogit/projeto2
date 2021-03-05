@extends('layouts.app', ['activePage' => 'group-management', 'titlePage' => __('Gerenciamento de Grupos')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Grupos') }}</h4>
                <p class="card-category"> {{ __('Aqui você pode gerenciar Grupos') }}</p>
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
                  <div class="col-12 text-right">
                    <a href="{{ route('grupos.create') }}" class="btn btn-sm btn-primary">{{ __('Adicionar Grupo') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                          {{ __('Nome') }}
                      </th>
                      <th>
                        {{ __('Criação') }}
                      </th>
                      <th class="text-right">
                        {{ __('Ações') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($grupos as $grupo)

                          <tr>
                            <td>
                              {{ $grupo->nome }}
                            </td>
                            <td>
                              {{ $grupo->created_at->format('Y-m-d') }}
                            </td>
                            <td class="td-actions text-right">

                                <form action="{{ route('grupos.destroy', $grupo) }}" method="post">
                                    @csrf
                                    @method('delete')

                                    <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('grupos.edit', $grupo) }}" data-original-title="" title="">
                                      <i class="material-icons">edit</i>
                                      <div class="ripple-container"></div>
                                    </a>
                                    @php
                                      $rota = route("grupos.destroy", $grupo)
                                    @endphp

                                    <button  type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick='deletar("{{$rota}}")' >
                                        <i class="material-icons">close</i>
                                        <div class="ripple-container"></div>
                                    </button>
                                </form>



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
