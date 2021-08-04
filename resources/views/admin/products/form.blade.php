@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="{{ asset('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }} ">
<link rel="stylesheet" href="{{ asset('node_modules/bootstrap3-wysihtml5-npm/dist/bootstrap3-wysihtml5.min.css') }}">
@stop

@section('title', 'Adicionar Produto')

@section('content_header')

    <h1>Marcas</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="active">{{ isset($product) ? 'Editar Produto' : 'Adicionar Produto' }}</li>
    </ol>

@stop

@section('content')
  <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ isset($product) ? 'Editar Produto' : 'Adicionar Produto' }}</h3>
    </div>
    <form role="form" method="POST" action="{{ isset($product) ? route('products.update', $product->id) : route('products.store')}}" enctype="multipart/form-data">
        {!! csrf_field() !!}
        @if(!empty($product))
            @method('PUT')
        @endif
        <div class="box-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label for="inputTitle">Título</label>
                        <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título do Produto" value="{{ isset($product) ? $product->title : old('title') }}">
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
                    <div class="form-group">
                        <label for="inputSegmento">Categoria</label>
                        <select class="form-control select2" name="category_id" id="inputSegmento" style="width: 100%;">
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}" {{ isset($product) ? (($item->id == $product->category->id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group @error('description') has-error @enderror">
                        <label for="inputContent">Descrição</label>
                        <textarea name="description" class="form-control conteudo" id="inputContent" placeholder="Descrição do Produto" rows="4">{{ isset($product) ? $product->description : old('description') }}</textarea>
                        @error('description')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group @error('file') has-error @enderror">
                        <label for="inputImage">Imagem</label>
                        <input type="file" name="file" class="form-control" id="inputImage">
                        @error('file')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @if(isset($product->file))
                            <div class="box-body">
                                <img class="img-panel img-responsive pad" src="{{ asset("storage/products/{$product->file}") }}" alt="{{ $product->title }}">
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
