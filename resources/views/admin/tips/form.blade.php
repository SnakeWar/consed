@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }} ">
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap3-wysihtml5-npm/dist/bootstrap3-wysihtml5.min.css') }}">
@stop

@section('title', 'Adicionar Postagem')

@section('content_header')

    <h1>Dicas</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('tips.index') }}">Dicas</a></li>
        <li class="active">{{ isset($tip) ? 'Editar Dica' : 'Adicionar Dica' }}</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ isset($tip) ? 'Editar Dica' : 'Adicionar Dica' }}</h3>
        </div>
        <form role="form" method="POST" action="{{ isset($tip) ? route('tips.update', $tip->id) : route('tips.store')}}" enctype="multipart/form-data">
            @csrf
            @if(!empty($tip))
                @method('PUT')
            @endif
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="inputTitle">Título</label>
                            <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título da Dica" value="{{ isset($tip) ? $tip->title : old('title') }}">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group @error('published_at') has-error @enderror">
                            <label for="inputData">Data de publicação</label>
                            <input type="text" name="published_at" class="form-control datepicker" id="inputData" placeholder="" value="{{ isset($tip) ? \Carbon\Carbon::parse($tip->published_at)->format('d/m/Y') : old('published_at') }}">
                            @error('published_at')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputSegmento">Categoria</label>
                            <select class="form-control select2" name="category_id" id="inputSegmento" style="width: 100%;">
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" {{ isset($tip) ? (($item->id == $tip->category->id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('content') has-error @enderror">
                            <label for="inputContent">Descrição</label>
                            <textarea name="content" class="form-control conteudo" id="inputContent" placeholder="Descrição da Postagem" rows="4">{{ isset($tip) ? $tip->content : old('content') }}</textarea>
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
                            @if(isset($tip->file))
                                <div class="box-body">
                                    <img class="img-panel img-responsive pad" src="{{ asset("storage/posts/{$tip->file}") }}" alt="{{ $tip->title }}">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group {{ $errors->has('author') ? 'has-error' : '' }}">
                            <label for="inputTitle">Autor</label>
                            <input type="text" name="author" class="form-control" id="inputTitle" placeholder="Autor" value="{{ isset($tip) ? $tip->author : old('author') }}">
                            @if ($errors->has('author'))
                                <span class="help-block">
                                <strong>{{ $errors->first('author') }}</strong>
                            </span>
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
