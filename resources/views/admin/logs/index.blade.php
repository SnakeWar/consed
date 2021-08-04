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
        <div class="box-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Data de criação</th>
                    <th>Id do registro</th>
                    <th>Usuário</th>
                    <th>IP do usuário</th>
                    <th>Método</th>
                    <th>URL</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($logs as $item)
                    <tr>
                        <td>{{ convertdata_tosite($item->created_at) }}</td>
                        <td>{{ $item->register_id }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->user_ip }}</td>
                        <td>{{ $item->method }}</td>
                        <td>{{ $item->url }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {!! $logs->links() !!}

        </div>
        <!-- /.box-body -->
    </div>
@stop