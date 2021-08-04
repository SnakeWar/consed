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
                    <div class="col-lg-6">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="inputTitle">Título</label>
                            <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título da Postagem" value="{{ isset($post) ? $post->title : old('title') }}">
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
                            <input type="text" name="published_at" class="form-control datetimepicker" id="inputData" placeholder="" value="{{ isset($post) ? \Carbon\Carbon::parse($post->published_at)->format('d/m/Y H:i') : old('published_at') }}">
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
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="inputTitle">Descrição</label>
                            <input type="text" name="description" class="form-control" id="inputTitle" placeholder="Descrição da Postagem" value="{{ isset($post) ? $post->description : old('description') }}">
                            @if ($errors->has('description'))
                                <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                @if(empty($user->category_id))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="inputSegmento">Categoria</label>
                                <select class="form-control select2" name="category_id" id="inputSegmento" @if(!empty($user->category_id)) disabled @endif style="width: 100%;">
                                    @if(!empty($user->category_id))
                                        @foreach ($categories as $item)
                                            @if($item->id == $user->category_id)
                                                <option value="{{ $item->id }}" {{ isset($post) ? (($item->id == $user->category_id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                            @endif
                                        @endforeach
                                    @endif

                                    @if(empty($user->category_id))
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}" {{ isset($post) ? (($item->id == $post->category->id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="inputSegmento">Tipo</label>
                                <select class="form-control select2" name="type" id="inputSegmento" style="width: 100%;">
                                        <option value="0" {{ isset($post) ? (($post->type == 0) ? 'selected' : '') : '' }}>Secundária</option>
                                        <option value="1" {{ isset($post) ? (($post->type == 1) ? 'selected' : '') : '' }}>Destaque</option>
                                        <option value="2" {{ isset($post) ? (($post->type == 2) ? 'selected' : '') : '' }}>Outra</option>
                                </select>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('content') has-error @enderror">
                            <label for="inputContent">Descrição</label>
                            <textarea name="content" class="form-control" id="editor1" placeholder="Descrição da Postagem" rows="4">{{ isset($post) ? $post->content : old('content') }}</textarea>
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
                            @if(isset($post->file))
                                <div class="box-body">
                                    <img class="img-panel img-responsive pad" src="{{ asset("storage/posts/{$post->file}") }}" alt="{{ $post->title }}">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="inputSegmento">Posição da imagem</label>
                            <select class="form-control select2" name="image_position" id="inputSegmento" style="width: 100%;">
                                <option value="top" {{ isset($post) ? (($post->image_position == 'top') ? 'selected' : '') : '' }}>Inicio</option>
                                <option value="bottom" {{ isset($post) ? (($post->image_position == 'bottom') ? 'selected' : '') : '' }}>Fim</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('image_credits') ? 'has-error' : '' }}">
                            <label for="inputTitle">Creditos da imagem</label>
                            <input type="text" name="image_credits" class="form-control" id="inputTitle" placeholder="Creditos da imagem" value="{{ isset($post) ? $post->image_credits : old('image_credits') }}">
                            @if ($errors->has('image_credits'))
                                <span class="help-block">
                                <strong>{{ $errors->first('image_credits') }}</strong>
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
