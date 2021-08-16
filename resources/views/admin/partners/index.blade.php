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
            <a href="{{ route($view.'.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Adicionar</a>
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
                    <th>Nome</th>
                    <th>
                        Site
                    </th>
                    <th>
                        Ativado?
                    </th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($model as $item)
                    <tr>
                        <td>{{ convertdata_tosite($item->created_at) }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->url }}</td>
                        <td>
                            <form action="{{ route($view.'.ativo', ['id' => $item->id])}}" style="margin-right: 5px" method="post">
                              @csrf
                              @if( $item->published == 1 )
                                <button class="btn btn-success" type="submit"><i class="fa fa-check"></i></button>
                              @else
                                <button class="btn btn-danger" type="submit"><i class="fa fa-minus"></i></button>
                              @endif
                            </form>
                          </td>
                        <td class="action">
                            <a href="{{ route($view.'.edit', $item->id) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route($view.'.destroy', $item->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {!! $model->links() !!}

        </div>
        <!-- /.box-body -->
    </div>
@stop
