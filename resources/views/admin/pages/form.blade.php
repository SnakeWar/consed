@extends('adminlte::page')

@section('css')
{{--    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }} ">--}}
{{--    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap3-wysihtml5-npm/dist/bootstrap3-wysihtml5.min.css') }}">--}}
@stop

@section('title', $title)

@section('content_header')

    <h1>{{ $subtitle }}</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route($view . '.index') }}">$title</a></li>
        <li class="active">{{ isset($post) ? 'Editar ' . $subtitle : 'Adicionar ' . $subtitle }}</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ isset($dado) ? 'Editar ' . $subtitle : 'Adicionar ' . $subtitle }}</h3>
        </div>
        <form role="form" method="POST" action="{{ isset($dado) ? route($view . '.update', $dado->id) : route($view . '.store')}}" enctype="multipart/form-data">
            @csrf
            @if(!empty($dado))
                @method('PUT')
            @endif
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="inputTitle">Título</label>
                            <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título da Postagem" value="{{ isset($dado) ? $dado->title : old('title') }}" {{ isset($dado) ? 'disabled' : '' }}>
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
                        <div class="form-group @error('content') has-error @enderror">
                            <label for="inputContent">Conteúdo</label>
                            <textarea name="content" class="form-control" id="editor1" placeholder="Descrição da Postagem" rows="4">{{ isset($dado) ? $dado->content : old('content') }}</textarea>
                            @error('content')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group @error('file') has-error @enderror">
                            <label for="inputImage">Imagem</label>
                            <input type="file" name="file" class="form-control" id="inputImage">
                            @error('file')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @if(isset($dado->file))
                                <div class="box-body">
                                    <img class="img-panel img-responsive pad" src="{{ asset("storage/pages/{$dado->file}") }}" alt="{{ $dado->title }}">
                                </div>
                            @endif
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
{{--    <script src="{{ asset('node_modules/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>--}}
{{--    <script src="{{ asset('node_modules/bootstrap3-wysihtml5-npm/dist/bootstrap3-wysihtml5.all.min.js') }}"></script>--}}
    <script src="{{ asset('node_modules/ckeditor/ckeditor.js') }}"></script>

    @include('ckfinder::setup')

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        if (typeof CKEDITOR !== 'undefined') {
            //CKEDITOR.disableAutoInline = true;
            CKEDITOR.addCss('img {max-width:100%; height: auto;}');
            var editor = CKEDITOR.replace('editor1', {
            plugin: "image", replacedWith: "image2"
            });
        } else {
            document.getElementById('editor1').innerHTML =
                '<div class="tip-a tip-a-alert">This sample requires working Internet connection to load CKEditor 4 from CDN.</div>'
        }
        CKFinder.setupCKEditor(editor);
    </script>
@stop
