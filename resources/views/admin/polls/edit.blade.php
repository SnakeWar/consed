@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="{{ asset('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }} ">
<link rel="stylesheet" href="{{ asset('node_modules/bootstrap3-wysihtml5-npm/dist/bootstrap3-wysihtml5.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<style>
    .attr-values:not(:first-of-type) {
        margin-top: 10px;
    }
</style>
@stop

@section('title', 'Adicionar enquete')

@section('content_header')

    <h1>{{$title}}</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('polls.index') }}">{{$title}}</a></li>
        <li class="active">{{ isset($poll) ? 'Editar enquete' : 'Adicionar enquete' }}</li>
    </ol>

@stop

@section('content')
  <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ isset($poll) ? 'Editar post' : 'Adicionar post' }}</h3>
    </div>
    <form role="form" method="POST" action="{{ isset($poll) ? route('polls.update', $poll->id) : route('polls.store')}}" enctype="multipart/form-data"
        onsubmit="beforeSubmit(event)">
        {!! csrf_field() !!}
        @if(!empty($poll))
            @method('PUT')   
        @endif

        <div class="box-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label for="inputTitle">Enquete</label>
                        <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título do enquete" value="{{ isset($poll) ? $poll->title : old('title') }}">
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group @error('published_at') has-error @enderror">
                        <label for="inputData">Data de publicação</label>
                        <input type="text" name="published_at" class="form-control datetimepicker" id="inputData" placeholder="" value="{{ isset($poll) ? \Carbon\Carbon::parse($poll->published_at)->format('d/m/Y H:i') : old('published_at') }}">
                        @error('published_at')
                        <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group @error('unpublished_at') has-error @enderror">
                        <label for="inputData">Data de despublicação</label>
                        <input type="text" name="unpublished_at" class="form-control datetimepicker" id="inputData" placeholder="" value="{{ isset($poll) ? \Carbon\Carbon::parse($poll->unpublished_at)->format('d/m/Y H:i') : old('unpublished_at') }}">
                        @error('unpublished_at')
                        <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label>Alternativas para enquete:</label>

                            @if(isset($alternatives[0]->id))
                                <div class="input-group">
                                    <span class="input-group-addon">
                                      1
                                    </span>
                                    <input type="hidden" name="id_question[]" value="{{ isset($alternatives[0]->id) ? $alternatives[0]->id : '' }}">
                                    <input type="text" name="title_question[]" class="form-control" value="{{ isset($alternatives[0]->title) ? $alternatives[0]->title : '' }}" required>
                                </div><br>
                            @endif

                            @if(isset($alternatives[1]->id)) 
                            <div class="input-group">
                                <span class="input-group-addon">
                                  2
                                </span>
                                  <input type="hidden" name="id_question[]" value="{{ isset($alternatives[1]->id) ? $alternatives[1]->id : '' }}">
                                <input type="text" name="title_question[]" class="form-control" value="{{ isset($alternatives[1]->title) ? $alternatives[1]->title : '' }}" required>
                                @endif
                            </div><br>

                            @if(isset($alternatives[2]->id))
                            <div class="input-group">
                                <span class="input-group-addon">
                                  3
                                </span>
                                <input type="hidden" name="id_question[]" value="{{ isset($alternatives[2]->id) ? $alternatives[2]->id : '' }}">
                                <input type="text" name="title_question[]" class="form-control" value="{{ isset($alternatives[2]->title) ? $alternatives[2]->title : '' }}">
                            </div><br>
                            @endif

                            @if(isset($alternatives[3]->id)) 
                            <div class="input-group">
                                <span class="input-group-addon">
                                  4
                                </span>
                                <input type="hidden" name="id_question[]" value="{{ isset($alternatives[3]->id) ? $alternatives[3]->id : '' }}">
                                <input type="text" name="title_question[]" class="form-control" value="{{ isset($alternatives[3]->title) ? $alternatives[3]->title : '' }}">
                            </div><br>
                            @endif

                            @if(isset($alternatives[4]->id))
                            <div class="input-group">
                                <span class="input-group-addon">
                                  5
                                </span>
                                <input type="hidden" name="id_question[]" value="{{ isset($alternatives[4]->id) ? $alternatives[4]->id : '' }}">
                                <input type="text" name="title_question[]" class="form-control" value="{{ isset($alternatives[4]->title) ? $alternatives[4]->title : '' }}">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
           
         
            
            
            <!-- <div id="conteudo-respostas">
                
            </div> -->

           


          

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn-block btn-lg btn-success">Enviar</button>
        </div>
    </form>
  </div>
@stop


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/locale/pt-br.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="{{ asset('node_modules/ckeditor/ckeditor.js') }}"></script>

    @include('ckfinder::setup');

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(function(){
            $('.datetimepicker').datetimepicker();

            function beforeSubmit(event) {
                var editor = CKEDITOR.instances.inputContent;
                editor.setData(editor.getData().replace(/<p>/gi, "<p class='card-text mt-5 mb-1'>"));
                return true;
            }


        });


    </script>

    
@stop