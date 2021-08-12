@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }} ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" integrity="sha256-b5ZKCi55IX+24Jqn638cP/q3Nb2nlx+MH/vMMqrId6k=" crossorigin="anonymous" />

@stop

@section('title', 'Adicionar Copyright')

@section('content_header')

    <h1>Copyright</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('copyrights.index') }}">Postagens</a></li>
        <li class="active">{{ isset($model) ? 'Editar Copyright' : 'Adicionar Copyright' }}</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ isset($model) ? 'Editar Copyright' : 'Adicionar Copyright' }}</h3>
        </div>
        <form role="form" method="POST" action="{{ isset($model) ? route('copyrights.update', $model->id) : route('copyrights.store')}}" enctype="multipart/form-data">
            @csrf
            @if(!empty($model))
                @method('PUT')
            @endif
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="inputTitle">Nome</label>
                            <input type="text" name="name" class="form-control" id="inputTitle" placeholder="Nome" value="{{ isset($model) ? $model->name : old('name') }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
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
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('author_license') ? 'has-error' : '' }}">
                            <label for="inputTitle">Autor</label>
                            <input type="text" name="author_license" class="form-control" id="inputTitle" placeholder="Autor" value="{{ isset($model) ? $model->author_license : old('author_license') }}">
                            @if ($errors->has('author_license'))
                                <span class="help-block">
                                <strong>{{ $errors->first('author_license') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('link') ? 'has-error' : '' }}">
                            <label for="inputTitle">Link</label>
                            <input type="text" name="link" class="form-control" id="inputTitle" placeholder="link" value="{{ isset($model) ? $model->link : old('link') }}">
                            @if ($errors->has('link'))
                                <span class="help-block">
                                <strong>{{ $errors->first('link') }}</strong>
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
