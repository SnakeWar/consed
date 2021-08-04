@extends('pages.layouts.layout')



@section('content')



    <section class="mt-4 mb-5">

        <div class="container-fluid">

            <div class="row justify-content-center">

                <!-- conteudo da pagina -->

                <div class="col-lg-8">

                    @include('pages.layouts.sections.top_banner_mobile')

                    <!-- listagem de noticias -->

                    <div class="row mt-md-5 ultimas-noticias">

                        <div class="col-md-12">

                            <ul>

                                @if($posts->count() > 0)

                                    @foreach($posts as $post)

                                        <li>

                                            <a href="{{ route('news_detail', [ 'slug' => $post->slug ] )}}">

                                                <div class="media align-items-center">

                                                    <img class="mr-3" src="{{ \Illuminate\Support\Facades\Storage::url("posts/{$post->file}") }}" alt="">

                                                    <div class="media-body">

                                                        <span>{{ $post->category->title }}</span>

                                                        <h5 class="mt-3 mb-1">{{ $post->title }}</h5>

                                                        <small>{{ convertdata_tosite($post->published_at) }}</small>

                                                        <p class="mt-4 card-text text-dark d-none d-sm-block">{{ $post->description }}</p>

                                                    </div>

                                                </div>

                                            </a>

                                        </li>

                                    @endforeach

                                    <div class="col-12">

                                        <div class="d-flex justify-content-end">

                                            <nav aria-label="Navegação de página exemplo">

                                                {{ $posts->links() }}

                                            </nav>

                                        </div>

                                    </div>

                                @else

                                    <div class="col-12">

                                        <h5 class="mt-0">Nada foi encontrado na pesquisa...</h5>

                                    </div>

                                @endif

                            </ul>

                        </div>

                    </div>



                    <!-- icone de carregamento -->

                    <!-- <div class="d-flex justify-content-center mt-5">

                        <img class="loading" src="{{ asset("assets/img/icon/loading.png") }}" alt="">

                    </div> -->

                </div>



                <!-- menu lateral -->

                @include('pages.layouts.sections._sidebar')

            </div>

        </div>

    </section>



@endsection