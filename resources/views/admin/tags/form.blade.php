@extends('adminlte::page')

@section('title', $subtitle)

@section('content_header')

    <h1>{{$title}}</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('tags.index') }}">{{$title}}</a></li>
        <li class="active">{{$subtitle}}</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{$subtitle}}</h3>
        </div>
        <form role="form" method="POST" action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store')}}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="inputTitle">Nome</label>
                            <input type="text" name="name" class="form-control" id="inputTitle" placeholder="Nome" value="{{ isset($tag) ? $tag->title : old('title') }}">
                            @error('name')
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
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