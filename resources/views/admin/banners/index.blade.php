@extends('adminlte::page')

@section('title', $title)

@php
  $types = [
      'top' => 'Topo',
      'between_posts' => 'Entre posts',
      'side' => 'Lateral',
      'popup' => 'PopUp'
  ];
@endphp

@section('content_header')

    <h1>{{$title}}</h1>

    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
      <li class="active">{{$title}}</li>
  </ol>

@stop

@section('content')
  <div class="box">
    <div class="box-header">
      <a href="{{ route('banners.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Adicionar</a>
    </div>
    @if(session()->has('success'))
      <div class="box-body">
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
      </div>
    @endif
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Data de criação</th>
          <th>Data de publicação</th>
          <th>Título</th>
          <th>Local</th>
          <th>Cliques</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
          @foreach ($lista as $item)
            <tr>
              <td>{{ convertdata_tosite($item->created_at) }}</td>
              <td>{{ convertdata_tosite($item->published_at) }}</td>
              <td>{{ $item->title }}</td>
              <td>{{ $types[$item->type] }}</td>
              <td>{{ $item->hits }}</td>
              <td class="action">
                <form action="{{ route('banners.ativo', ['id' => $item->id])}}" style="margin-right: 5px" method="POST">
                  @csrf
                  @if( $item->status == 1 )

                    <button class="btn btn-success" type="submit"><i class="fa fa-check"></i></button>
                  @else

                    <button class="btn btn-danger" type="submit"><i class="fa fa-minus"></i></button>
                  @endif
                </form>
                <a href="{{ route('banners.edit', $item->id) }}" class="btn btn-primary">Editar</a>
                <form action="{{ route('banners.destroy', $item->id)}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      {!! $lista->links() !!}

    </div>
    <!-- /.box-body -->
  </div>
@stop
