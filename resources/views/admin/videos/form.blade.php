@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }} ">
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap3-wysihtml5-npm/dist/bootstrap3-wysihtml5.min.css') }}">
@stop

@section('title', 'Adicionar')

@section('content_header')

    <h1>{{$title}}</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('videos.index') }}">{{$title}}</a></li>
        <li class="active">{{ isset($dado) ? 'Editar' : 'Adicionar' }}</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ isset($dado) ? 'Editar' : 'Adicionar' }}</h3>
        </div>
        <form role="form" method="POST" action="{{ isset($dado) ? route('videos.update', $dado->id) : route('videos.store')}}" enctype="multipart/form-data">
            @csrf
            @if(!empty($dado))
                @method('PUT')
            @endif
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="inputTitle">Título</label>
                            <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título da Postagem" value="{{ isset($dado) ? $dado->title : old('title') }}">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group @error('src') has-error @enderror">
                            <label for="inputImage">Source</label>
                            <input type="text" name="src" class="form-control" id="inputImage" value="{{ isset($dado) ? $dado->src : old('src') }}">
                            @error('src')
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
                            <label for="inputImage">Descrição</label>
                            <input type="text" name="description" class="form-control" id="inputImage" value="{{ isset($dado) ? $dado->description : old('description') }}">
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


@section('js')
    <script src="{{ asset('node_modules/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('node_modules/bootstrap3-wysihtml5-npm/dist/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script src="{{ asset('node_modules/ckeditor/ckeditor.js') }}"></script>

    @include('ckfinder::setup');

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        // var editor = CKEDITOR.replace( this.id, {
        //     filebrowserBrowseUrl: 'http://localhost/node_modules/ckfinder/ckfinder.html',
        //     filebrowserUploadUrl: 'http://localhost/node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        // });
        // CKFinder.setupCKEditor( editor , 'ckfinder/');

        $(function(){
            $('.money').mask("###0.00", {reverse: true});
            $('.data').mask("99/99/9999");
        })
    </script>
@stop
