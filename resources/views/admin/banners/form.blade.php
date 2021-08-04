@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }} ">
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap3-wysihtml5-npm/dist/bootstrap3-wysihtml5.min.css') }}">
@stop

@section('title', 'Adicionar Banner')

@section('content_header')

    <h1>Banners</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('banners.index') }}">Banner</a></li>
        <li class="active">{{ isset($banner) ? 'Editar Banner' : 'Adicionar Banner' }}</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ isset($banner) ? 'Editar Banner' : 'Adicionar Banner' }}</h3>
        </div>
        <form role="form" method="POST" action="{{ isset($banner) ? route('banners.update', $banner->id) : route('banners.store')}}" enctype="multipart/form-data">
            @csrf
            @if(!empty($banner))
                @method('PUT')
            @endif
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="inputTitle">Título</label>
                            <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título da Banner" value="{{ isset($banner) ? $banner->title : old('title') }}">
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
                            <input type="text" name="published_at" class="form-control datepicker" id="inputData" placeholder="" value="{{ isset($banner) ? \Carbon\Carbon::parse($banner->published_at)->format('d/m/Y') : old('published_at') }}">
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
                        <div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
                            <label for="inputUrl">URL</label>
                            <input type="text" name="url" class="form-control" id="inputUrl" placeholder="Url do Banner" value="{{ isset($banner) ? $banner->url : old('url') }}">
                            @if ($errors->has('url'))
                            <span class="help-block">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputSegmento">Tipo</label>
                            <select class="form-control select2" name="type" id="inputSegmento" style="width: 100%;">
                                    <option value="top" {{ isset($banner) ? (($banner->type == 'top') ? 'selected' : '') : '' }}>Topo</option>
                                    <option value="between_posts" {{ isset($banner) ? (($banner->type == 'between_posts') ? 'selected' : '') : '' }}>Entre posts</option>
                                    <option value="side" {{ isset($banner) ? (($banner->type == 'side') ? 'selected' : '') : '' }}>Lateral</option>
                                    <option value="popup" {{ isset($banner) ? (($banner->type == 'popup') ? 'selected' : '') : '' }}>PopUp</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('file') has-error @enderror">
                            <label for="inputImage">Imagem desktop</label>
                            <input type="file" name="file" class="form-control" id="inputImage">
                            @error('file')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @if(isset($banner->file))
                                <div class="box-body">
                                    <img class="img-panel img-responsive pad" src="{{ \Illuminate\Support\Facades\Storage::url("banners/{$banner->file}") }}" alt="{{ $banner->title }}">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('file_mobile') has-error @enderror">
                            <label for="inputImage">Imagem mobile</label>
                            <input type="file" name="file_mobile" class="form-control" id="inputImageMobile">
                            @error('file_mobile')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @if(isset($banner->file_mobile))
                                <div class="box-body">
                                    <img class="img-panel img-responsive pad" src="{{ \Illuminate\Support\Facades\Storage::url("banners/{$banner->file_mobile}") }}" alt="{{ $banner->title }}">
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

    @include('ckfinder::setup');

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
@stop
