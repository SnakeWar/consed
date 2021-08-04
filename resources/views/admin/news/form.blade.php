@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }} ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" integrity="sha256-b5ZKCi55IX+24Jqn638cP/q3Nb2nlx+MH/vMMqrId6k=" crossorigin="anonymous" />

@stop

@section('title', 'Adicionar Postagem')

@section('content_header')

    <h1>Blog</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('posts.index') }}">Postagens</a></li>
        <li class="active">{{ isset($post) ? 'Editar Postagem' : 'Adicionar Postagem' }}</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ isset($post) ? 'Editar Postagem' : 'Adicionar Postagem' }}</h3>
        </div>
        <form role="form" method="POST" action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store')}}" enctype="multipart/form-data">
            @csrf
            @if(!empty($post))
                @method('PUT')
            @endif
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('visible') ? 'has-error' : '' }}">
                            <label for="inputVisible">Notícia Pública?</label>
                            <input type="checkbox" name="visible" class="form-control" id="inputVisible">
                            @if ($errors->has('visible'))
                                <span class="help-block">
                                <strong>{{ $errors->first('visible') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="inputGallery">Galeria de Imagens</label>
                            <select name="gallery_id" id="inputGallery">
                                <option value=""></option>
                                @foreach ($galleries as $item)
                                    <option value="{{ $item->id }}" {{ isset($post) ? (($item->id == $post->gallery_id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
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
                        <div class="form-group {{ $errors->has('tag_id') ? 'has-error' : '' }}">
                            <label for="inputTag">Chapéu</label>
                            <select name="tag_id" id="inputTag">
                                <option value=""></option>
                                @foreach ($tags as $item)
                                    <option value="{{ $item->id }}" {{ isset($post) ? (($item->id == $post->tag_id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('tag_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tag_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="inputTitle">Título*</label>
                            <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título da Postagem" value="{{ isset($post) ? $post->title : old('title') }}">
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
                        <div class="form-group {{ $errors->has('subtitle') ? 'has-error' : '' }}">
                            <label for="inputSubtitle">Subtítulo</label>
                            <input type="text" name="subtitle" class="form-control" id="inputSubtitle" placeholder="Descrição da Postagem" value="{{ isset($post) ? $post->description : old('description') }}">
                            @if ($errors->has('subtitle'))
                                <span class="help-block">
                                <strong>{{ $errors->first('subtitle') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('file') has-error @enderror">
                            <label for="inputImage">Capa da Notícia*</label>
                            <input type="file" name="file" class="form-control" id="inputImage">
                            @error('file')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @if(isset($post->file))
                                <div class="box-body">
                                    <img class="img-panel img-responsive pad" src="{{ asset("storage/posts/{$post->file}") }}" alt="{{ $post->title }}">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('content') has-error @enderror">
                            <label for="inputContent">Conteúdo*</label>
                            <textarea name="content" class="form-control" id="editor1" placeholder="" rows="4">{{ isset($post) ? $post->content : old('content') }}</textarea>
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
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="inputGallery">Tags*</label>
                            <select name="gallery_id" id="inputGallery" multiple>
                                <option value=""></option>
                                @foreach ($galleries as $item)
                                    <option value="{{ $item->id }}" {{ isset($post) ? (($item->id == $post->gallery_id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
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
                        <div class="form-group @error('copyright_id') has-error @enderror">
                            <label for="inputData">Direito autoral*</label>
                            <input type="text" name="copyright_id" class="form-control datetimepicker" id="inputData" placeholder="" value="{{ isset($post) ? $post->publication : old('copyright_id') }}">
                            @error('copyright_id')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('publication') has-error @enderror">
                            <label for="inputData">Publicada em*</label>
                            <input type="text" name="published_at" class="form-control datetimepicker" id="inputData" placeholder="" value="{{ isset($post) ? \Carbon\Carbon::parse($post->publication)->format('d/m/Y H:i') : old('publication') }}">
                            @error('publication')
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
    <script src="{{ asset('node_modules/ckeditor/ckeditor.js') }}"></script>
    @include('ckfinder::setup');

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>
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

        $(function () {
            $('.datetimepicker').datetimepicker({
                locale: 'pt-br'
            });
        });

        CKFinder.setupCKEditor(editor);
    </script>
@stop
