@extends('adminlte::page')

@section('title', $subtitle)

@section('content_header')

    <h1>{{$title}}</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('categories.index') }}">{{$title}}</a></li>
        <li class="active">{{$subtitle}}</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{$subtitle}}</h3>
        </div>
        <form role="form" method="POST" action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store')}}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="inputTitle">Título</label>
                            <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título" value="{{ isset($category) ? $category->title : old('title') }}">
                            @error('title')
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
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