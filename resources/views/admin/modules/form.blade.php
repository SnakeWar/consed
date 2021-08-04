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
        <form role="form" method="POST" action="{{ isset($module) ? route('modules.update', $module->id) : route('modules.store')}}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="inputTitle">Título do módulo</label>
                            <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título do módulo" value="{{ isset($module) ? $module->title : old('title') }}">
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
                        <div class="form-group @error('url') has-error @enderror">
                            <label for="inputURL">URL</label>
                            <input type="text" name="url" class="form-control" id="inputURL" placeholder="URL do módulo" value="{{ isset($module) ? $module->url : old('url') }}"/>
                            @error('url')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('description') has-error @enderror">
                            <label for="inputDesc">Descrição</label>
                            <textarea name="description" class="form-control" id="inputDesc" placeholder="Descrição breve do grupo" rows="4">{{ isset($module) ? $module->description : old('description') }}</textarea>
                            @error('description')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn-block btn-lg btn-success">Enviar</button>
            </div>
        </form>
    </div>
@stop