@extends('adminlte::page')

@section('title', $subtitle)

@section('content_header')

    <h1>{{$title}}</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('roles.index') }}">{{$title}}</a></li>
        <li class="active">{{ $subtitle }}</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $subtitle }}</h3>
        </div>
        <form role="form" method="POST" action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store')}}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="inputTitle">Título do grupo</label>
                            <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Administrador" value="{{ isset($role) ? $role->title : old('title') }}">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('description') has-error @enderror">
                            <label for="inputDesc">Descrição</label>
                            <textarea name="description" class="form-control" id="inputDesc" placeholder="Descrição breve do grupo" rows="4">{{ isset($role) ? $role->description : old('description') }}</textarea>
                            @error('description')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped data-table">
                    <caption><h2>Módulos deste grupo e suas permissões</h2></caption>
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Acessar</th>
                        <th>Adicionar</th>
                        <th>Atualizar</th>
                        <th>Deletar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($modules as $module)
                        <tr>
                            <td>{{ $module->title }}</td>
                            <td>{{ Form::checkbox('permissions[]', @$module->permissions[0]->id, (isset($permissions[@$module->permissions[0]->id]) &&!is_null($permissions[@$module->permissions[0]->id])) ? true : false) }}</td>
                            <td>{{ Form::checkbox('permissions[]', @$module->permissions[1]->id, (isset($permissions[@$module->permissions[1]->id]) &&!is_null($permissions[@$module->permissions[1]->id])) ? true : false) }}</td>
                            <td>{{ Form::checkbox('permissions[]', @$module->permissions[2]->id, (isset($permissions[@$module->permissions[2]->id]) &&!is_null($permissions[@$module->permissions[2]->id])) ? true : false) }}</td>
                            <td>{{ Form::checkbox('permissions[]', @$module->permissions[3]->id, (isset($permissions[@$module->permissions[3]->id]) &&!is_null($permissions[@$module->permissions[3]->id])) ? true : false) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn-block btn-lg btn-success">Enviar</button>
            </div>
        </form>
    </div>
@stop
