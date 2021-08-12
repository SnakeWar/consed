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
        <li><a href="{{ route('gallery.index') }}">{{$title}}</a></li>
        <li class="active">{{ isset($model) ? 'Editar' : 'Adicionar' }}</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ isset($model) ? 'Editar' : 'Adicionar' }}</h3>
        </div>
        <form role="form" method="POST" action="{{ isset($model) ? route('gallery.update', $model->id) : route('gallery.store')}}" enctype="multipart/form-data">
            @csrf
            @if(!empty($model))
                @method('PUT')
            @endif
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group {{ $errors->has('visible') ? 'has-error' : '' }}">
                            <label for="visible">Galeria Pública?</label><br>
                            <input type="checkbox" name="visible" id="visible" {{ isset($model) ? (($model->visible == 1) ? 'checked' : '') : '' }}>
                            @if ($errors->has('visible'))
                                <span class="help-block">
                                <strong>{{ $errors->first('visible') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="inputTags">Tags*</label><br>
                            <select name="tags[]" id="inputTags" class="select2 form-control" multiple>
                                <option value=""></option>
                                @foreach ($tags as $item)
                                    <option value="{{ $item->id }}" {{ isset($model) ? (($model->tags->contains($item)) ? 'selected' : '') : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group @error('date') has-error @enderror">
                            <label for="inputData">Data</label>
                            <input type="text" name="date" class="form-control datetimepicker" id="inputData" placeholder="" value="{{ isset($model) ? \Carbon\Carbon::parse($model->date)->format('d/m/Y H:i') : old('date') }}">
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
                    <div class="col-lg-12">
                        <div class="form-group @error('capa') has-error @enderror">
                            <label for="inputImage">Capa</label>
                            <input type="file" name="capa" class="form-control" id="inputImage" {{ isset($model) ? '' : 'required' }}>
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('file') has-error @enderror">
                            <label for="inputImage">Imagens</label>
                            <input type="file" name="file[]" class="form-control" id="inputImage" multiple>
                            <span class="text-red">Segure Ctrl ou Command para selecionar mais de uma imagem</span>
                            @error('file')
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
    @if(isset($model->photos))
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                
                <div class="box-header">
                    <h3>Fotos</h3>
                </div>
                @foreach ($model->photos as $item)
                    <div class="col-lg-4" style="margin-top:30px">
                        <form action="{{ route('gallery.removePhoto', $item->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">x</button>
                        </form>
                        <img class="img-panel img-responsive pad" src="{{ asset("storage/{$item->image}") }}" alt="{{ $model->title }}">
                        
                    </div>
                @endforeach
            
            </div>
        </div>
    </div>
    @endif
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
