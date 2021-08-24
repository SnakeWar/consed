@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }} ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" integrity="sha256-b5ZKCi55IX+24Jqn638cP/q3Nb2nlx+MH/vMMqrId6k=" crossorigin="anonymous" />
@stop

@section('title', 'Adicionar '.$subtitle)

@section('content_header')

    <h1>{{ $subtitle }}</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route($view.'.index') }}">{{ $subtitle }}</a></li>
        <li class="active">{{ isset($model) ? 'Editar '.$subtitle : 'Criar '.$subtitle }}</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ isset($model) ? 'Editar '.$subtitle : 'Adicionar '.$subtitle }}</h3>
        </div>
        <form role="form" method="POST" action="{{ isset($model) ? route($view.'.update', $model->id) : route($view.'.store')}}" enctype="multipart/form-data">
            @csrf
            @if(!empty($model))
                @method('PUT')
            @endif
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="inputTitle">Nome*</label>
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
                        <div class="form-group {{ $errors->has('cpf') ? 'has-error' : '' }}">
                            <label for="inputTitle">CPF*</label>
                            <input type="text" name="cpf" class="form-control cpf" id="inputTitle" placeholder="CPF" value="{{ isset($model) ? $model->cpf : old('cpf') }}">
                            @if ($errors->has('cpf'))
                                <span class="help-block">
                                <strong>{{ $errors->first('cpf') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('land_line') ? 'has-error' : '' }}">
                            <label for="inputTitle">Telefone Fixo*</label>
                            <input type="text" name="land_line" class="form-control telefone-fixo" id="inputTitle" placeholder="Telefone Fixo" value="{{ isset($model) ? $model->land_line : old('land_line') }}">
                            @if ($errors->has('land_line'))
                                <span class="help-block">
                                <strong>{{ $errors->first('land_line') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('mobile_phone') ? 'has-error' : '' }}">
                            <label for="inputTitle">Celular*</label>
                            <input type="text" name="mobile_phone" class="form-control telefone" id="inputTitle" placeholder="Celular" value="{{ isset($model) ? $model->mobile_phone : old('mobile_phone') }}">
                            @if ($errors->has('mobile_phone'))
                                <span class="help-block">
                                <strong>{{ $errors->first('mobile_phone') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('corporate_mobile') ? 'has-error' : '' }}">
                            <label for="inputTitle">Celular Corporativo*</label>
                            <input type="text" name="corporate_mobile" class="form-control telefone" id="inputTitle" placeholder="Celular Corporativo" value="{{ isset($model) ? $model->corporate_mobile : old('corporate_mobile') }}">
                            @if ($errors->has('corporate_mobile'))
                                <span class="help-block">
                                <strong>{{ $errors->first('corporate_mobile') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('birth') has-error @enderror">
                            <label for="inputData">Data de Nascimento*</label>
                            <input type="text" name="birth" class="form-control datemask" id="inputData" placeholder="" value="{{ isset($model) ? \Carbon\Carbon::parse($model->birth)->format('d/m/Y') : old('birth') }}">
                            @error('birth')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('alternative_email') ? 'has-error' : '' }}">
                            <label for="inputTitle">E-mail*</label>
                            <input type="email" name="alternative_email" class="form-control" id="inputTitle" placeholder="E-mail" value="{{ isset($model) ? $model->alternative_email : old('alternative_email') }}">
                            @if ($errors->has('alternative_email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('alternative_email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="inputTitle">E-mail Alternativo*</label>
                            <input type="email" name="email" class="form-control" id="inputTitle" placeholder="E-mail" value="{{ isset($model) ? $model->email : old('email') }}">
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
                        <div class="form-group @error('file') has-error @enderror">
                            <label for="inputImage">Imagem*</label>
                            <input type="file" name="file" class="form-control" id="inputImage">
                            @error('file')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @if(isset($model->image))
                                <div class="box-body">
                                    <img class="img-panel img-responsive pad" src="{{ asset("storage/persons/{$model->image}") }}" alt="{{ $model->title }}">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('profile') has-error @enderror">
                            <label for="inputContent">Perfil*</label>
                            <textarea name="profile" class="form-control" id="editor1" placeholder="" rows="4">{{ isset($model) ? $model->profile : old('profile') }}</textarea>
                            @error('profile')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">
            Endereço
        </h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group {{ $errors->has('alias') ? 'has-error' : '' }}">
                    <label for="inputTitle">Alias*</label>
                    <input type="text" name="alias" class="form-control" id="inputTitle" placeholder="Alias" value="{{ isset($model) ? $model->address->alias : old('alias') }}">
                    @if ($errors->has('alias'))
                        <span class="help-block">
                        <strong>{{ $errors->first('alias') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group {{ $errors->has('postcode') ? 'has-error' : '' }}">
                    <label for="inputTitle">CEP*</label>
                    <input type="text" name="postcode" class="form-control cep" id="cep" placeholder="CEP" value="{{ isset($model) ? $model->address->postcode : old('postcode') }}">
                    @if ($errors->has('postcode'))
                        <span class="help-block">
                        <strong>{{ $errors->first('postcode') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group {{ $errors->has('city2') ? 'has-error' : '' }}">
                    <label for="inputTitle">Cidade*</label>
                    <input type="text" name="city2" class="form-control" id="cidade" placeholder="Cidade" value="{{ isset($model) ? $model->address->city2 : old('city2') }}">
                    @if ($errors->has('city2'))
                        <span class="help-block">
                        <strong>{{ $errors->first('city2') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group {{ $errors->has('district') ? 'has-error' : '' }}">
                    <label for="inputTitle">Bairro*</label>
                    <input type="text" name="district" class="form-control" id="bairro" placeholder="Bairro" value="{{ isset($model) ? $model->address->district : old('district') }}">
                    @if ($errors->has('district'))
                        <span class="help-block">
                        <strong>{{ $errors->first('district') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <input type="hidden" id="ibge" name="city">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group {{ $errors->has('street') ? 'has-error' : '' }}">
                    <label for="inputTitle">Rua*</label>
                    <input type="text" name="street" class="form-control" id="rua" placeholder="Alias" value="{{ isset($model) ? $model->address->street : old('street') }}">
                    @if ($errors->has('street'))
                        <span class="help-block">
                        <strong>{{ $errors->first('street') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group {{ $errors->has('number') ? 'has-error' : '' }}">
                    <label for="inputTitle">Número*</label>
                    <input type="text" name="number" class="form-control" id="inputTitle" placeholder="Número" value="{{ isset($model) ? $model->address->number : old('number') }}">
                    @if ($errors->has('number'))
                        <span class="help-block">
                        <strong>{{ $errors->first('number') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group {{ $errors->has('complement') ? 'has-error' : '' }}">
                    <label for="inputTitle">Complemento*</label>
                    <input type="text" name="complement" class="form-control" id="inputTitle" placeholder="Complemento" value="{{ isset($model) ? $model->address->complement : old('complement') }}">
                    @if ($errors->has('complement'))
                        <span class="help-block">
                        <strong>{{ $errors->first('complement') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
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
     <!-- Adicionando Javascript -->
     <script>

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                            //console.log(dados);
                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    </script>
@stop
