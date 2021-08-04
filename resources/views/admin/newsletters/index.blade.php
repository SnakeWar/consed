@extends('adminlte::page')

@section('title', $title)

@section('content_header')

    <h1>{{$title}}</h1>

    <a class="btn btn-primary" style="margin-top:10px" target="_blank" href="{{ route('news.export') }}">Exportar</a>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li class="active">{{$title}}</li>
    </ol>

@stop

@section('content')
    <div class="box">
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
                    <th>Email</th>
                    <th>Lido</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($lista as $item)
                    <tr>
                        <td>{{ convertdata_tosite($item->created_at) }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->lido == 1 ? 'Lido' : "Não lido" }}</td>
                        <td class="action">
                            <a href="{{ route('newsletters.show', $item->id) }}" class="btn btn-primary">Visualizar</a>
                            <form action="{{ route('newsletters.destroy', $item->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                @can("delete_".$module, App\Models\Newsletter::class)
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                @endcan
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
