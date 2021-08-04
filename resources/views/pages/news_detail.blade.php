@extends('pages.layouts.layout')



@section('content')



    <section id="news_detail">

        <div class="container-fluid">

            <div class="row noticias d-flex justify-content-center">

                <div class="col-lg-8">

                    @include('pages.layouts.sections.top_banner_mobile')

                    <div class="row mt-md-5 noticia_detalhes">

                        <div class="col-md-12">

                            <h1>{{ $post->title }}</h1>

                            @if(!empty($post->file) && ($post->image_position === 'top' || empty($post->image_position)))

                                <figure>
                                    <img class="w-100" src="{{ \Illuminate\Support\Facades\Storage::url("posts/{$post->file}") }}" alt="">
                                    <figcaption style="font-style: italic;margin-top: 5px;margin-left: 5px;font-size: 14px;">{{ $post->image_credits }}</figcaption>
                                </figure>

                            @endif

                            <div class="d-flex justify-content-between mt-3 mb-2">

                                <small>{{ convertdata_tosite($post->published_at) }}</small>

                                <div>
                                    <div class="right addthis_inline_share_toolbox"></div><br>

                                    <!-- <a href="">

                                        <img src="{{ asset("assets/img/icon/email.png") }}" alt="">

                                    </a>

                                    <a href="">

                                        <img src="{{ asset("assets/img/icon/compartilhar2.png") }}" alt="">

                                    </a> -->

                                </div>

                            </div>

                            {!! $post->content !!}

                            @if(!empty($post->file) && ($post->image_position === 'bottom'))

                                <figure>
                                    <img class="w-100" src="{{ \Illuminate\Support\Facades\Storage::url("posts/{$post->file}") }}" alt="">
                                    <figcaption style="font-style: italic;margin-top: 5px;margin-left: 5px;font-size: 14px;">{{ $post->image_credits }}</figcaption>
                                </figure>

                            @endif

                        </div>

                    </div>

                    <div class="col-lg-12 pl-0 mt-4">

                        <h4> Deixe seu comentário</h4>

                        <form id="comentario" class="mb-5 mt-4" action="{{route('comentario')}}" method="POST">

                            @csrf

                            <div class="row">

                                <input type="hidden" name="post_id" value="{{$post->id}}">

                                <div class="col-md-6 col-sm-6">

                                    <div class="form-group">

                                        <input type="email" id="email-contato" name="email" class="form-control" placeholder="E-mail"/>

                                    </div>

                                </div><!-- md-6 -->

                                <div class="col-xl-6 col-md-6 col-sm-6">

                                    <div class="form-group">

                                        <input type="text" id="nome-contato" name="nome" class="form-control" placeholder="Seu nome"/>

                                    </div>

                                </div><!-- md-6 -->

                            </div><!-- row -->

                            <div class="row">

                                <div class="col-xl-12 col-md-12 col-sm-12">

                                    <div class="form-group">

                                        <textarea class="form-control" id="mensagem" name="mensagem" placeholder="Mensagem"></textarea>

                                    </div>

                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary ml-1 mt-2">ENVIAR</button>

                        </form>

                    </div>



                    <div class="col-lg-12 pl-0">

                        <h4> {{ ($post->comments->count() > 0) ? $post->comments->count() : '0' }} Comentário(s)</h4>

                        <hr>

                        @if(isset($post->comments))

                            @foreach($post->comments as $key => $comment)

                                <ul class="media-list">

                                    <li class="media">

                                        <div class="media-left">

                                            <span class="glyphicon glyphicon-user user" aria-hidden="true"></span>

                                        </div>

                                        <div class="media-body">



                                            <h5 class="media-heading">{{$comment->nome}} - <small>{{$comment->email}}</small></h5>

                                            {{$comment->mensagem}}



                                            @foreach(($responses = \App\Models\Comment::with('responses')->where('id', $comment->id)->first())->responses as $response)



                                                <div class="media">

                                                    <ul class="media-list">

                                                        <li class="media">

                                                            <div class="media-left">

                                                                <span class="glyphicon glyphicon-user user" aria-hidden="true"></span>

                                                            </div>

                                                            <div class="media-body">

                                                                <h5 class="media-heading">{{$response->nome}} - <small>{{$response->email}}</small></h5>

                                                                {{$response->mensagem}}

                                                            </div>

                                                        </li>

                                                    </ul>

                                                </div>



                                            @endforeach



                                            <div class="mensagem_form">

                                                <a role="button" data-toggle="collapse" href="#collapseForm{{ $key }}" aria-expanded="false" aria-controls="collapseForm{{ $key }}">

                                                    Adicionar comentário

                                                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>

                                                </a>

                                            </div>



                                            <div class="collapse" id="collapseForm{{ $key }}">

                                                <form id="frm-contato" action="{{route('resposta')}}" method="POST">

                                                    @csrf

                                                    <div class="row">

                                                        <input type="hidden" name="comment_id" value="{{$comment->id}}">

                                                        <div class="col-md-6 col-sm-6 col-xl-6 col-lg-6">

                                                            <div class="form-group">

                                                                <input type="email" id="email-contato" name="email" class="form-control"

                                                                       placeholder="E-mail"/>

                                                            </div>

                                                        </div><!-- md-6 -->

                                                        <div class="col-md-6 col-sm-6 col-xl-6 col-lg-6">

                                                            <div class="form-group">

                                                                <input type="text" id="nome-contato" name="nome" class="form-control"

                                                                       placeholder="Seu nome"/>

                                                            </div>

                                                        </div><!-- md-6 -->

                                                    </div><!-- row -->

                                                    <div class="row">

                                                        <div class="col-md-12 col-sm-12 col-xl-12 col-lg-12">

                                                            <div class="form-group">

                                                                <textarea class="form-control" id="mensagem" name="mensagem" placeholder="Mensagem"></textarea>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <button type="submit" class="btn btn-primary">ENVIAR</button>

                                                </form>

                                            </div>



                                        </div>

                                    </li>

                                </ul>

                                <hr>



                            @endforeach

                        @endif

                    </div>

                    <div class="row entretenimento mt-5">

                        <div class="col-12">

                            <h1 class="text-uppercase">notícias relacionadas </h1>

                        </div>

                        @foreach($related as $item)
                            <div class="col-6 col-md-4 col-lg-3">

                                <a href="{{ route('news_detail', [ 'slug' => $item->slug ] )}}">

                                    <div class="card  border-0">

                                        <img src="{{ \Illuminate\Support\Facades\Storage::url("posts/{$item->file}") }}" alt="">

                                        <div class="card-body pl-0">

                                            <h5 class="card-title  text-dark">{{ $item->title }}</h5>

                                            <div class="d-flex justify-content-start">
                                                <small>{{ $item->category->title }}</small>
                                            </div>

                                        </div>

                                    </div>

                                </a>

                            </div>
                        @endforeach

                    </div>

                </div>

                @include('pages.layouts.sections._sidebar')

            </div>

        </div>

    </section>



@endsection