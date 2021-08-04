@extends('adminlte::page')

@section('title', $subtitle)

@section('content_header')

    <h1>{{$title}}</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('users.index') }}">{{$title}}</a></li>
        <li class="active">{{ $subtitle }}</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $subtitle }}</h3>
        </div>
        <form role="form" method="POST" action="{{ isset($user) ? route('users.update', $user->id) : route('users.store')}}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="inputName">Nome do usuário</label>
                            <input type="text" name="name" class="form-control" id="inputName" placeholder="Nome do usuário" value="{{ isset($user) ? $user->name : old('name') }}">
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
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="inputEmail">E-mail de login</label>
                            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="teste@teste.com" value="{{ isset($user) ? $user->email : old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="inputPassword">Senha @if(!empty($senha_padrao)) <i>( padrão:  {{@$senha_padrao}} )</i> @endif</label>
                            <input type="password" name="password" class="form-control" id="inputPassword" value="{{@$senha_padrao}}">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            <label for="inputPasswordConfirmation">Confirme a senha</label>
                            <input type="password" name="password_confirmation" class="form-control" id="inputPasswordConfirmation" value="{{@$senha_padrao}}">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputRole">Grupos</label>
                            <select class="form-control select2" name="role_id" id="inputRole" style="width: 100%;">
                                @foreach ($roles as $item)
                                    <option value="{{ $item->id }}" {{ (isset($user) && isset($user->roles->first()->id)) ? (($item->id == $user->roles->first()->id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputSegmento">Categoria</label>
                            <select class="form-control select2" name="category_id" id="inputSegmento" style="width: 100%;">
                                <option value="">Selecione</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" {{ isset($user) ? (($item->id == $user->category_id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
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
                            @if(isset($user->file))
                                <div class="box-body">
                                    <img class="img-panel img-responsive pad" src="{{ asset("storage/users/{$user->file}") }}" alt="{{ $user->title }}">
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