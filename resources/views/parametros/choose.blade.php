@extends('layouts.app', ['activePage' => 'par-management', 'titlePage' => __('Gerenciamento de Parâmetros')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          @foreach($parametros as $p)
          <a href="{{route('parametros.edit', $p->id)}}" class='btn btn-primary'>{{$p->id}}</a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
