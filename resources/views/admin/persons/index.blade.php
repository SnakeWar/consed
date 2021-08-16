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

    {{-- <form style="padding: 10px" method="get">
      @csrf

      <h3>Filtros</h3>
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            <label for="inputTitle">Título</label>
            <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título da Postagem" value="{{ app('request')->query('title') ? app('request')->query('title') : ''}}">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="inputSegmento">Destaque</label>
            <select class="form-control select2" name="type">
              <option value="" {{ !app('request')->query('type') ? '' : 'selected'}}>Todos</option>
              <option value="0" {{ app('request')->query('type') === '0'  ? 'selected' : '' }}>Secundária</option>
              <option value="1" {{ app('request')->query('type') ? ((app('request')->query('type') == 1) ? 'selected' : '') : '' }}>Destaque</option>
              <option value="2" {{ app('request')->query('type') ? ((app('request')->query('type') == 2) ? 'selected' : '') : '' }}>Outra</option>
            </select>
          </div>
        </div>
      </div>

      <button class="btn btn-primary" type="submit">Filtrar</button>
      <a href="/admin/news" class="btn btn-warning">Limpar filtros</a>
    </form> --}}

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
          <th>#</th>
          <th>Nome</th>
          <th>CPF</th>
          <th>Telefone Fixo</th>
          <th>Celular</th>
          <th>E-mail</th>
          <th>Data Nascimento</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($model as $item)
            <tr>
              <td>{{ $item->id }}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->cpf }}</td>
              <td>{{ $item->land_phone }}</td>
              <td>{{ $item->mobile_phone }}</td>
              <td>{{ $item->email }}</td>
              <td>{{ convertdata_tosite($item->birth, false) }}</td>
              <td>
                <form action="{{ route($view.'.destaque', ['id' => $item->id])}}" style="margin-right: 5px" method="post">
                  @csrf
                  @if( $item->highlight == 1 )
                    <button class="btn btn-success" type="submit"><i class="fa fa-check"></i></button>
                  @else
                    <button class="btn btn-danger" type="submit"><i class="fa fa-minus"></i></button>
                  @endif
                </form>
              </td>
              
            </tr>
          @endforeach
        </tbody>
      </table>

      {!! $model->appends(app('request')->query())->links() !!}

    </div>
    <!-- /.box-body -->
  </div>
@stop
