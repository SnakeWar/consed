@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }} ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" integrity="sha256-b5ZKCi55IX+24Jqn638cP/q3Nb2nlx+MH/vMMqrId6k=" crossorigin="anonymous" />
@stop

@section('title', 'Adicionar')

@section('content_header')

    <h1>{{$title}}</h1>
    @if(session()->has('success'))
    <div class="box-body">
      <div class="alert alert-success">
          {{ session()->get('success') }}
      </div>
    </div>
    @endif
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('videos_gallery.index') }}">{{$title}}</a></li>
        <li class="active">{{ isset($model) ? 'Editar' : 'Adicionar' }}</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ isset($model) ? 'Editar' : 'Adicionar' }}</h3>
        </div>
        <form id="formVideo" role="form" method="POST" action="{{ isset($model) ? route('videos_gallery.update', $model->id) : route('videos_gallery.store')}}" enctype="multipart/form-data">
            @csrf
            @if(!empty($model))
                @method('PUT')
            @endif
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group @error('date') has-error @enderror">
                            <label for="inputData">Data</label>
                            <input type="text" name="date" class="form-control datetimepicker" id="inputData" placeholder="" value="{{ isset($model) ? convertdata_tosite($model->date) : old('date') }}">
                            @error('date')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="inputTitle">Título</label>
                            <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título da Galeria" value="{{ isset($model) ? $model->title : old('title') }}">
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
                        <div class="form-group @error('description') has-error @enderror">
                            <label for="inputContent">Descrição*</label>
                            <textarea name="description" class="form-control" id="editor1" placeholder="" rows="4">{{ isset($model) ? $model->description : old('description') }}</textarea>
                            @error('description')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group @error('capa') has-error @enderror">
                            <label for="inputImage">Capa</label>
                            <input type="file" name="capa" class="form-control" id="inputImage">
                            @error('capa')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @if(isset($model->photo))
                                    <div class="box-body">
                                        <img class="img-panel img-responsive pad" src="{{ asset("storage/{$model->photo->image}") }}" alt="{{ $model->title }}">
                                    </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="videos">

                </div>
                <a id="botao_videos" class="btn btn-success">+ Adicionar Vídeo</a>
                
                
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <a id="botaoFormVideo" class="btn-block btn-lg btn-success text-center">Enviar</a>
            </div>
        </form>
    </div>
    @if(isset($model->videos))
        <div class="box box-primary">
            <div class="box-body">
                <h3>Vídeos</h3>
                @foreach ($model->videos as $item)
                    <div class="row">
        
                        <div class="col-lg-4">
                            <div class="form-group @error('video[title][]') has-error @enderror">
                                <label for="inputImage">Título</label>
                                <input type="text" name="" class="form-control" id="inputImage" value="{{ $item->title }}" disabled>
                                
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group @error('video[url][]') has-error @enderror">
                                <label for="inputImage">URL</label>
                                <input type="text" name="" class="form-control" id="inputImage" value="{{ $item->url }}" disabled>
                                
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group @error('video[source][]') has-error @enderror">
                                <label for="inputImage">Fonte</label>
                                <input type="text" name="" class="form-control" id="inputImage" value="{{ $item->source }}" disabled>
                                
                            </div>
                        </div>
                        <div class="col-lg-1" style="padding-top: 25px">
                            <form id="formVideoDelete" action="{{ route('videos_gallery.removeVideo', ['id' => $item->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" id="minus_videos" class="btn btn-danger">-</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
            </div>
        </div>
@stop


@section('js')
    <script src="{{ asset('node_modules/ckeditor/ckeditor.js') }}"></script>
    @include('ckfinder::setup')
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
        $(document).on('click', '#minus_videos2', function () {
        $(this).closest('#formNovo').remove();
        });
        $('#botaoFormVideo').click(function(event){
            event.preventDefault();
            $('#formVideo').submit();
        });
        $('#botaoVideoDelete').click(function(event){
            event.preventDefault();
            $('#minus_videos').submit();
        });
        var num = 0;
        $("#botao_videos").click(function (event) {
        event.preventDefault();
        var html = '';
        num++;
        html += `
        <div class="row" id="formNovo">
            <div class="col-lg-4">
                <div class="form-group @error('video[${num}][title]') has-error @enderror">
                    <label for="inputImage">Título</label>
                    <input type="text" name="video[${num}][title]" class="form-control" id="inputImage">
                    @error('video[${num}][title]')
                    <span class="help-block">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group @error('video[${num}][url]') has-error @enderror">
                    <label for="inputImage">URL</label>
                    <input type="text" name="video[${num}][url]" class="form-control" id="inputImage" >
                    @error('video[${num}][url]')
                    <span class="help-block">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-3">
                    <div class="form-group @error('video[${num}][source]') has-error @enderror">
                        <label for="inputImage">Fonte</label>
                        <input type="text" name="video[${num}][source]" class="form-control" id="inputImage">
                        @error('video[${num}][source]')
                        <span class="help-block">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                        </div>
            <div class="col-lg-1" style="padding-top: 25px"><button id="minus_videos2" class="btn btn-danger">-</button></div>
        </div>
        `

        $('#videos').append(html);
        });
    </script>
@stop
