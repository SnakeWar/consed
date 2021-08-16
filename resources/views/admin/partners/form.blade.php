@extends('adminlte::page')

@section('title', $subtitle)

@section('content_header')

    <h1>{{$title}}</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route($view.'.index') }}">{{$title}}</a></li>
        <li class="active">{{$subtitle}}</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{$subtitle}}</h3>
        </div>
        <form role="form" method="POST" action="{{ isset($model) ? route($view.'.update', $model->id) : route($view.'.store')}}" enctype="multipart/form-data">
            @csrf
            @if($model)
                @method('put')
            @endif
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="inputTitle">Nome</label>
                            <input type="text" name="name" class="form-control" id="inputTitle" placeholder="Nome" value="{{ isset($model) ? $model->name : old('title') }}">
                            @error('name')
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('url') has-error @enderror">
                            <label for="inputTitle">Site</label>
                            <input type="text" name="url" class="form-control" id="inputTitle" placeholder="Site" value="{{ isset($model) ? $model->url : old('url') }}">
                            @error('url')
                            <span class="help-block">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('file') has-error @enderror">
                            <label for="inputTitle">Imagem</label>
                            <input type="file" name="file" class="form-control" id="inputTitle" placeholder="Imagem">
                            @error('file')
                            <span class="help-block">
                                <strong>{{ $errors->first('file') }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                @isset($model)
                <div class="row">
                    <div class="col-lg-4">
                        <img src="{{ asset("storage/partners/$model->image") }}" alt="">
                    </div>
                </div>
                @endisset
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn-block btn-lg btn-success">Enviar</button>
            </div>
        </form>
    </div>
@stop