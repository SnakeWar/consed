@extends('adminlte::page')

@section('title', 'Seja nosso parceiro')

@section('content_header')

    <h1>Seja nosso parceiro</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('partners.index') }}">Seja nosso parceiro</a></li>
        <li class="active">Visualizar contato</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Visualizar contato</h3>
        </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputTitle">Nome</label>
                            <input type="text" name="name" class="form-control" id="inputName" disabled value="{{ $partner->name }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                           <label for="inputPhone">Telefone</label>
                           <input type="text" name="phone" class="form-control" id="inputPhone" disabled value="{{ $partner->phone }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="text" name="email" class="form-control" id="inputEmail" disabled value="{{ $partner->email }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="inputEmail">Cidade</label>
                            <input type="text" name="city" class="form-control" id="inputCity" disabled value="{{ $partner->city }}">
                       </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                            <div class="form-group">
                                <label for="inputEmail">Estado</label>
                                <input type="text" name="state" class="form-control" id="inputState" disabled value="{{ $partner->state }}">
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                            <div class="form-group">
                                <label for="inputEmail">Tipo de parceiro</label>
                                <input type="text" name="partner_type" class="form-control" id="inputPartner" disabled value="{{ $partner->partner_type }}">
                            </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
    </div>
@stop
