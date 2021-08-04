@extends('pages.layouts.layout')

@section('meta')
<meta property="og:type" content=" " />
<meta property="og:title" content=" " />
<meta property="og:site_name" content=" " />
<meta property="og:url" content="" />

<meta property="og:description" content=" " />
<meta property="og:image" content="{{asset('storage/teste.jpg')}}" />
@endsection

@section('content')
    
<section class="contato w3-container w3-center w3-animate-left">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-md-11 mt-4">
                        <div class="card border-0">
                            <div class="card-body text-left pl-0">
                                <h2>Enquete</h2>
                                <hr />
                            </div>
                        </div>

                         <div class="box-body">
                            <div class="alert alert-success d-none">
                            </div>
                         </div>

						 <div class="box-body">
                            <div class="alert alert-danger d-none">
                            </div>
                        </div>

                        @if(isset($enquete))
                            <div id="boxEnquete">
    	                        <h2>{{ $enquete->title }}</h2>
    	                        <form action="#" id="enquete">
    	                            @csrf
    	                            <input type="hidden" name="id_poll" value="{{ $enquete->id }}">
    	                            <div class="form-row">
        	                            @foreach($enquete->alternatives as $item)
        		                            <div class="col-md-12 col-sm-12">
        			                            <div class="form-check">
                                                    <label class="form-check-label" for="exampleRadios{{ $item->id }}">
                                                        <input class="form-check-input" type="radio" id="exampleRadios{{ $item->id }}" required name="id_alternative" value="{{ $item->id }}">
                                                        {{$item->title}}
                                                    </label>
        										</div>
        									</div>
        								@endforeach

                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" required name="name" placeholder="Nome">
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" required name="email" placeholder="Email">
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" required name="telephone" placeholder="Telefone">
                                            </div>
                                        </div>
    	                            <div class="form-row">
    	                                <div class="col-md-12">
    	                                    <button type="submit" class="btn btn-enviar text-white">Enviar</button>
    	                                </div>
    	                            </div>
    	                        </form>
                            </div>
                        @else
                            <div class="col-md-12 col-lg-12">
                                <p align="center">Nenhuma enquete no momento.</p>
                            </div>
                        @endif

                        <div id="boxResultado" class="d-none">
                            <p align="center" class="text-dark"><strong>Resultado Parcial</strong></p>
                            <div id="titleEnquete"></div>
                        	<div id="contentResultado">                                   
                            </div>                        	
                            <a id="voltarEnquete" class="btn btn-primary text-light"><i class="fa fa-arrow-circle-left"></i> Voltar</a>
                        </div>

                        <br><br>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(function (){
            $('#enquete').submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: "{{ route('enquete_send')}}",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response){
                        if(response.status == 200){
                            //console.log(response.status);
                            $('#boxEnquete').addClass('d-none');
                            $('.alert-danger').addClass('d-none');
                            $('#boxResultado').removeClass('d-none');
                            $('.alert-success').fadeIn().removeClass('d-none').html(response.message);
                            $('#boxResultado').html(response.dados.alternatives);
                        }else{
                            $('.alert-danger').fadeIn().removeClass('d-none').html(response.message);
                            setTimeout(function(){location.href="/enquete"} , 3000);
                        }
                    }
                }).done(function(response) {
                    var total = parseInt(response.dados.votos.total);
                    $('#boxResultado').removeClass('d-none');
                    $('#titleEnquete').html("<p align='left'>" + response.dados.poll.title + "</p><br />");
                    $.each(response.dados.poll.alternatives, function(index, value){
                        $('#contentResultado').append('<div class="row"><div class="col-sm-6 col-lg-3"><p class="text-dark">'+ value.title +'</p></div><div class="col-sm-6 col-lg-9"><div class="progress" style="height: 20px;"><div class="progress-bar progress-bar-striped" role="progressbar" style="width: '+ Math.round((value.votes/total)*100) +'%; color: #fff; font-size: 14px;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"> '+ Math.round((value.votes/total)*100) +'%</div>'+
                            '</div></div></div><br />');
                    });
                });
            });

            $('#voltarEnquete').click(function(){
                window.location.href = "/enquete";
            });
        });
    </script>
@endsection

@section('css')
   <style>
       #boxEnquete h2 {
           font-family: 'Lato', sans-serif;
           font-style: normal;
           font-weight: 900;
           font-size: 24px;
           color: #828282;
           text-align: left;
           margin: 0 0 20px;
       }
       #boxEnquete .form-check-label {
           margin-bottom: 10px;
           font-size: 20px;
           display: flex;
           align-items: center;
       }
       #boxEnquete .btn-enviar {
           background-color: #93338a;
           width: inherit;
           border-radius: 15px;
           padding: 12px 40px;
           text-transform: uppercase;
           display: table;
           width: auto;
           margin-top: 20px;
       }

       #voltarEnquete {
           background-color: #93338a;
           width: inherit;
           border-radius: 15px;
           padding: 12px 40px;
           text-transform: uppercase;
           display: table;
           width: auto;
           margin-top: 20px;
           border: none;
       }

   </style>
@endsection