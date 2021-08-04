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
      <a href="{{ route('polls.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Adicionar</a>
    </div>
    @if(session()->has('success'))
      <div class="box-body">
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
      </div>
    @endif
    <div class="box-body">
      <table class="table table-bordered table-striped hidden-xs">
        <thead>
        <tr>
          <th>Enquete</th>
          <th>Data de publicação</th>
          <th>Data de despublicação</th>
          <th>Status</th>
          <th>Ações</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($lista as $item)
            <tr>
              <td>
                {{ $item->title }}
                <br>
                <a href="{{ route('polls.show', $item->id) }}">
                  Pré-visualizar
                </a>  
              </td>

              <td>
                  {{ convertdata_tosite($item->published_at) }}
              </td>


                <td>
                    {{ convertdata_tosite($item->unpublished_at) }}
                </td>
             
              

              <td>          
                <form action="{{ route('polls.active', $item->id) }}" method="post">
                    @csrf
                    <button class="btn {{ ($item->status === 1) ? ('btn-success') : ('btn-danger') }}" type="submit">{{ ($item->status === 1) ? 'Publicada' : 'Despublicada' }}</button>
                </form>
            </td>
            
              <td class="action">
                <a href="{{ route('polls.edit', $item->id) }}" class="btn btn-primary">Editar</a>
                <form action="{{ route('polls.destroy', $item->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <table class="table table-bordered table-striped visible-xs">
        <tbody>
          @foreach ($lista as $item)

            <tr>
              <th>Título</th>
              <td>
                {{ $item->title }}
                <br>
                <a href="{{ route('polls.show', $item->id) }}">
                  Pré-visualizar
                </a>
              </td>
            </tr>

            <tr>
              <th>Data de publicação</th>
              <td>{{ convertdata_tosite($item->published_at) }}</td>
            </tr>

            <tr>
              <th>Data de despublicação</th>
              <td>{{ convertdata_tosite($item->unpublished_at) }}</td>
            </tr>
          
        
            <tr>
              <th>Status</th>
              <td>          
                 <form action="{{ route('polls.active', $item->id) }}" method="post">
                    @csrf
                    <button class="btn {{ ($item->status === 1) ? ('btn-success') : ('btn-danger') }}" type="submit">{{ ($item->status === 1) ? 'Publicada' : 'Despublicada' }}</button>
                </form>
              </td>
            </tr>
            <tr>
              <th></th>
              <td class="action">
                <a href="{{ route('polls.edit', $item->id) }}" class="btn btn-primary">Editar</a>
                <form action="{{ route('polls.destroy', $item->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
              </td>
            </tr>
            <tr class="borda"><td></td><td></td></tr>
          @endforeach
        </tbody>
      </table>

     
     

      {!! $lista->links() !!}

    </div>
    <!-- /.box-body -->
  </div>

@stop
