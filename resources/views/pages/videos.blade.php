@extends('pages.layouts.layout')



@section('content')



    <section class="mt-4 mb-5">

        <div class="container-fluid">

            <div class="row justify-content-center">

                @include('pages.layouts.sections.top_banner_mobile')

                <!-- conteudo da pagina -->

                <div class="col-lg-8">

                    <!-- listagem de noticias -->

                    <div class="row mt-md-5 ultimas-noticias">

                        <div class="col-md-12">

                            <ul>

                                @php
                                    $count = is_array($videos) ? count($videos) : $videos->count();
                                @endphp

                                @if($count > 0)

                                    @foreach($videos as $video)

                                        <li>

                                            <a href="{{ isset($video['src']) ? $video['src'] : $video->src }}" target="_blank">

                                                <div class="media align-items-center">

                                                    <img style="height: 220px;object-fit: cover;" class="mr-3" src="{{ isset($video['thumb']) ? $video['thumb'] : $video->getThumb() }}" alt="">

                                                    <div class="media-body">

                                                        <h5 class="mt-5 mb-5">{{ isset($video['title']) ? htmlspecialchars_decode($video['title']) : $video->title }}</h5>

                                                        <small>{{ convertdata_tosite(isset($video['created_at']) ? $video['created_at'] : $video->created_at) }}</small>

                                                    </div>

                                                </div>

                                            </a>

                                        </li>

                                    @endforeach

                                    <div class="col-12">

                                        <div class="d-flex justify-content-center">

                                            @if(is_array($videos))
                                                <div class="top_link mt-3">
                                                    <a class="btn musica" target="_blank" href="https://www.youtube.com/channel/UCPvUFqjcgSQ_CIiZn_DqQMQ"> Veja mais

                                                        <i class="ml-2 fab fa-youtube"></i>

                                                    </a>
                                                </div>
                                            @else
                                                <nav aria-label="Navegação de página exemplo">
                                                    {{ $videos->links() }}
                                                </nav>
                                            @endif

                                        </div>

                                    </div>

                                @endif

                            </ul>

                        </div>

                    </div>

                </div>



                <!-- menu lateral -->

                @include('pages.layouts.sections._sidebar')

            </div>

        </div>

    </section>



@endsection