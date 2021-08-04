@extends('adminlte::page')

@section('title', $title)

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
      <a href="{{ route('tips.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Adicionar</a>
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
          <th>Autor</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
          @foreach ($lista as $item)
            <tr>
              <td>{{ convertdata_tosite($item->created_at) }}</td>
              <td>{{ convertdata_tosite($item->published_at) }}</td>
              <td>{{ $item->title }}</td>
              <td>{{ $item->author }}</td>
              <td class="action">
                <a href="{{ route('tips.edit', $item->id) }}" class="btn btn-primary">Editar</a>
                <form action="{{ route('tips.destroy', $item->id)}}" method="post">
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
