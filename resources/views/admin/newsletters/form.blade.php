@extends('adminlte::page')

@section('title', 'Trabalhe conosco')

@section('content_header')

    <h1>Trabalhe conosco</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('work_with_us.index') }}">Trabalhe conosco</a></li>
        <li class="active">Visualizar contato</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Visualizar contato</h3>
        </div>
            <div class="box-body">
{{--                <div class="row">--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="inputPhone">Telefone</label>--}}
{{--                            <input type="text" name="phone" class="form-control" id="inputPhone" disabled value="{{ $contact->phone }}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="text" name="email" class="form-control" id="inputEmail" disabled value="{{ $contact->email }}">
                        </div>
                    </div>
                </div>
{{--                <div class="row">--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="inputEmail">Cidade</label>--}}
{{--                            <input type="text" name="city" class="form-control" id="inputEmail" disabled value="{{ $contact->city }}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="inputEmail">UF</label>--}}
{{--                            <input type="text" name="uf" class="form-control" id="inputEmail" disabled value="{{ $contact->uf }}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-12">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="inputEmail">Área de interesse</label>--}}
{{--                            <input type="text" name="interest_area" class="form-control" id="inputEmail" disabled value="{{ $contact->interest_area }}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-12">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="">Currículo</label>--}}
{{--                            <a href="{{ asset("/storage/contacts/{$contact->file}") }}" target="_blank" rel=”noopener noreferrer”>Ver</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputContent">Conteúdo</label>
                            <textarea rows="4" name="content" class="form-control" id="inputContent" disabled>{{ $contact->message }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
    </div>
@stop
