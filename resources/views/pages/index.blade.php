@extends('pages.layouts.layout')

<!-- preloader -->

<div id="preloader">

    <div class="inner">

        <div class="bolas">

            <div></div>

            <div></div>

            <div></div>

        </div>

    </div>

</div>

@section('content')



    <section class="mt-4 mb-5">

        <div class="container-fluid">

            <div class="row justify-content-center">

                <!-- conteudo da pagina -->

                <div class="col-lg-8">

                    @include('pages.layouts.sections.top_banner_mobile')

                    <!-- noticias destaques -->

                    @if(!empty($lives) || (!empty($featured) && $featured->type === 'video'))
                        <div style="margin-left:0;margin-right:0;margin-top:10px;margin-bottom:10px;" class="row noticias">
                            <div style="position: relative;padding-bottom: 56.25%;height: 0;overflow: hidden;max-width: 100%;" class="col-12">
                                <iframe type="text/html" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;" src="{{ (new \App\Models\Video)->getEmbed(!empty($lives) ? $lives[0]['src'] : $featured->url) }}" frameborder="0"></iframe>
                            </div>
                        </div>
                    @endif

                    @if(empty($lives) && (empty($featured) || $featured->type === 'posts'))
                        <div class="row noticias">

                            @if(isset($featureds[0]))

                                <div class="col-sm-7 col-xl-7">

                                    <a class="m-2" href="{{ route('news_detail', [ 'slug' => $featureds[0]->slug ] )}}">

                                        <div class="card destaque destaque-maior">

                                            <img class="w-100" src="{{ \Illuminate\Support\Facades\Storage::url("posts/{$featureds[0]->file}") }}" alt="" style="height: 366px;">

                                            <div class="card-body">

                                                <span>{{ $featureds[0]->category->title }}</span>

                                                <p class="mt-2">{{ $featureds[0]->title }}</p>

                                            </div>

                                        </div>

                                    </a>

                                </div>

                            @endif



                            @php

                                $featureds->shift()

                            @endphp


                            <div class="col-sm-5 col-xl-5 d-md-none">

                                <div class="row">
                                    @foreach($featureds as $item)

                                        <a class="col-6 @if($loop->first) pl-3 pr-1 @endif @if($loop->last) pr-3 pl-1 @endif" href="{{ route('news_detail', [ 'slug' => $item->slug ] )}}">

                                            <div class="card destaque destaque-menor">

                                                <img class="w-100" src="{{ \Illuminate\Support\Facades\Storage::url("posts/{$item->file}") }}" alt="" style="height: 170px;">

                                                <div class="card-body">

                                                    <span>{{ $item->category->title }}</span>

                                                    <p class="mt-1">{{ $item->title }}</p>

                                                </div>

                                            </div>

                                        </a>

                                    @endforeach
                                </div>

                            </div>


                            <div class="col-sm-5 col-xl-5 d-none d-md-block">

                                @foreach($featureds as $item)

                                    <a class="m-1" href="{{ route('news_detail', [ 'slug' => $item->slug ] )}}">

                                        <div class="card destaque destaque-menor">

                                            <img class="w-100" src="{{ \Illuminate\Support\Facades\Storage::url("posts/{$item->file}") }}" alt="" style="height: 170px;">

                                            <div class="card-body">

                                                <span>{{ $item->category->title }}</span>

                                                <p class="mt-1">{{ $item->title }}</p>

                                            </div>

                                        </div>

                                    </a>

                                @endforeach

                            </div>

                        </div>
                    @endif



                    @if(isset($banners[0]))

                        <a href="{{ route('banner_hit', [ 'slug' => $banners[0]->slug ] )}}" target="_blank">

                            <img class="w-100 d-none d-md-block" src="{{ \Illuminate\Support\Facades\Storage::url("banners/{$banners[0]->file}") }}" alt="">

                            <img class="w-100 d-block d-lg-none" src="{{ \Illuminate\Support\Facades\Storage::url("banners/" . ($banners[0]->file_mobile ? $banners[0]->file_mobile : $banners[0]->file)) }}" alt="">

                        </a>

                    @endif



                    <!-- ultimas noticias -->

                    <div class="row mt-5 ultimas-noticias">

                        <div class="col-12">

                            <h1>Últimas notícias</h1>

                        </div>

                        <div class="col-md-6 border-right">



                            <ul>

                                @foreach($posts_1 as $item)

                                    <li>

                                        <a href="{{ route('news_detail', [ 'slug' => $item->slug ] )}}">

                                            <div class="media" style="height: 145px;overflow: hidden;">

                                                <img class="mr-3" src="{{ \Illuminate\Support\Facades\Storage::url("posts/{$item->file}") }}" alt="">

                                                <div class="media-body">

                                                    <span>{{ $item->category->title }}</span>

                                                    <h5 class="mt-0">{{ $item->title }}</h5>

                                                    <small>{{ convertdata_tosite($item->published_at) }}</small>

                                                </div>

                                            </div>

                                        </a>

                                    </li>

                                @endforeach

                            </ul>

                        </div>

                        <div class="col-md-6">

                            <ul>

                                @foreach($posts_2 as $item)

                                    <li>

                                        <a href="{{ route('news_detail', [ 'slug' => $item->slug ] )}}">

                                            <div style="min-height: 105px" class="media">

                                                <div class="media-body">

                                                    <span>{{ $item->category->title }}</span>

                                                    <h5 class="mt-0">{{ $item->title }}</h5>

                                                    <small>{{ convertdata_tosite($item->published_at) }}</small>

                                                </div>

                                            </div>

                                        </a>

                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>



                    <!-- entretenimento -->

                    <div class="row mt-5 mb-3 entretenimento">

                        <div class="col-12">

                            <h1>{{ $category->title }}</h1>

                        </div>

                        @foreach($category_items as $item)

                            <div class="col-sm-6 col-md-4 col-lg-4">

                                <a href="{{ route('news_detail', [ 'slug' => $item->slug ] )}}">

                                    <div style="min-height: 321px" class="card">

                                        <img @if(!$loop->first) class="d-none d-lg-block" @endif src="{{ \Illuminate\Support\Facades\Storage::url("posts/{$item->file}") }}" alt="">

                                        <div class="card-body">

                                            <h5 class="card-title">{{ $item->title }}</h5>

                                            <p class="card-text">

                                                <img src="{{ asset("assets/img/icon/play.png") }}" alt="">

                                                {{ $item->description }}

                                            </p>



                                            <div class="d-flex justify-content-end">

                                                <small>{{ $item->category->title }}</small>

                                                <!-- <img class="ml-2" src="{{ asset("assets/img/icon/compartilhar.png") }}" alt=""> -->



                                            </div>

                                        </div>

                                    </div>

                                </a>

                            </div>

                        @endforeach

                    </div>



                    @if(isset($banners[1]))

                        <a href="{{ route('banner_hit', [ 'slug' => $banners[1]->slug ] )}}" target="_blank">

                            <img class="w-100 d-none d-md-block" src="{{ \Illuminate\Support\Facades\Storage::url("banners/{$banners[1]->file}") }}" alt="">

                            <img class="w-100 d-block d-lg-none" src="{{ \Illuminate\Support\Facades\Storage::url("banners/" . ($banners[1]->file_mobile ? $banners[1]->file_mobile : $banners[1]->file)) }}" alt="">

                        </a>

                    @endif

                    <div class="noticias mt-2 d-block d-sm-none">
                        <div class="row">
                            <div class="col-md-6 col-lg-12">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="recentes-tab" data-toggle="tab" href="#recentes" role="tab" aria-controls="recentes" aria-selected="false">Mais recentes</a></li>
                                    <li class="nav-item"><a class="nav-link" id="lidas-tab" data-toggle="tab" href="#lidas" role="tab" aria-controls="lidas" aria-selected="true">Mais lidas</a></li>
                                    <li class="nav-item"><a class="nav-link" id="comentadas-tab" data-toggle="tab" href="#comentadas" role="tab" aria-controls="comentadas" aria-selected="false">Mais comentadas</a></li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="recentes" role="tabpanel" aria-labelledby="recentes-tab">
                                        <ul class="">
                                            @foreach($recent_posts as $top_post)
                                                <li class="border-bottom pb-4 mt-3"><a href="{{ route('news_detail', [ 'slug' => $top_post->slug ]) }}">{{ $top_post->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="lidas" role="tabpanel" aria-labelledby="lidas-tab">
                                        <ul class="">
                                            @foreach($top_hits as $top_post)
                                                <li class="border-bottom pb-4 mt-3"><a href="{{ route('news_detail', [ 'slug' => $top_post->slug ]) }}">{{ $top_post->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="comentadas" role="tabpanel" aria-labelledby="comentadas-tab">
                                        <ul class="">
                                            @foreach($top_comments as $top_post)
                                                <li class="border-bottom pb-4 mt-3"><a href="{{ route('news_detail', [ 'slug' => $top_post->slug ]) }}">{{ $top_post->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        
                            <div class=" col-md-6 col-lg-12 opinioes">
                                @if(isset($banners[1]))
                                    <a href="{{ route('banner_hit', [ 'slug' => $banners[1]->slug ] )}}" target="_blank">
                                        <img class="mt-3 w-100 d-none d-md-block" src="{{ \Illuminate\Support\Facades\Storage::url("banners/{$banners[1]->file}") }}" alt="">
                                        <img class="mt-3 w-100 d-block d-lg-none" src="{{ \Illuminate\Support\Facades\Storage::url("banners/" . ($banners[1]->file_mobile ? $banners[1]->file_mobile : $banners[1]->file)) }}" alt="">
                                    </a>
                                @endif

                                @if(!empty($blogs))
                                    <div class="d-flex justify-content-between mt-3 _mais">
                                        <h1 class="pl-2 text-uppercase">{{ $category_secondary->title }}</h1>
                                    </div>
                                    <div class="opinioes_info">
                                        <div class="card-body">
                                            @foreach($blogs as $item)
                                                <a href="{{ route('news') . '?blog=' . $item['id'] }}">
                                                    <div class="media d-flex align-items-center">
                                                        @if($item->file)
                                                            <img class="w-auto mr-3" src="{{ \Illuminate\Support\Facades\Storage::url("users/{$item->file}") }}" alt="">
                                                        @endif
                                                        <div class="media-body">
                                                            <h5 class="mt-0">{{ $item->name }}</h5>
                                                        </div>
                                                    </div>
                                                </a>
                                                @if(!$loop->last)
                                                    <hr class="mt-3 mb-3">
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5 mb-3 entretenimento">

                        <div class="col-12">

                            <h1>INSTAGRAM </h1>

                        </div>

                        <div class="col-12">

                            <!-- SnapWidget -->
                            <script src="https://snapwidget.com/js/snapwidget.js"></script>
                            <iframe src="https://snapwidget.com/embed/942342" class="snapwidget-widget" allowtransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden;  width:100%; "></iframe>

                        </div>

                    </div>



                    @if(isset($banners[2]))

                        <a href="{{ route('banner_hit', [ 'slug' => $banners[2]->slug ] )}}" target="_blank">

                            <img class="w-100 d-none d-md-block" src="{{ \Illuminate\Support\Facades\Storage::url("banners/{$banners[2]->file}") }}" alt="">

                            <img class="w-100 d-block d-lg-none" src="{{ \Illuminate\Support\Facades\Storage::url("banners/" . ($banners[2]->file_mobile ? $banners[2]->file_mobile : $banners[2]->file)) }}" alt="">

                        </a>

                    @endif



                    <!-- outras noticias -->



                    <div class="row mt-5 ultimas-noticias">

                        <div class="col-md-12">

                            <ul>

                                @foreach($others_1 as $item)

                                    <li>

                                        <a href="{{ route('news_detail', [ 'slug' => $item->slug ] )}}">

                                            <div class="media align-items-center">

                                                <img class="mr-3 img-noticias-meio" src="{{ \Illuminate\Support\Facades\Storage::url("posts/{$item->file}") }}" alt="">

                                                <div class="media-body">

                                                    <span>{{ $item->category->title }}</span>

                                                    <h5 class="mt-2 mb-1">{{ $item->title }}</h5>

                                                    <small>{{ convertdata_tosite($item->published_at) }}</small>

                                                    <p class="mt-3 card-text text-dark d-none d-sm-block">

                                                        {{ $item->description }}

                                                    </p>

                                                </div>

                                            </div>

                                        </a>

                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>



                    @if(isset($banners[3]))

                        <a href="{{ route('banner_hit', [ 'slug' => $banners[3]->slug ] )}}" target="_blank">

                            <img class="w-100 d-none d-md-block" src="{{ \Illuminate\Support\Facades\Storage::url("banners/{$banners[3]->file}") }}" alt="">

                            <img class="w-100 d-block d-lg-none" src="{{ \Illuminate\Support\Facades\Storage::url("banners/" . ($banners[3]->file_mobile ? $banners[3]->file_mobile : $banners[3]->file)) }}" alt="">

                        </a>

                    @endif



                    @if(isset($others_2[0]))

                        <div class="row noticias d-flex align-items-top">

                            <div class="col-lg-12 mt-3 mb-3">

                                <a class="m-2" href="{{ route('news_detail', [ 'slug' => $others_2[0]->slug ] )}}">

                                    <div class="card destaque">

                                        <img class="w-100" src="{{ \Illuminate\Support\Facades\Storage::url("posts/{$others_2[0]->file}") }}" alt="">

                                        <div class="card-body">

                                            <span>{{ $others_2[0]->category->title }}</span>



                                            <p class="mt-2">

                                                {{ $others_2[0]->title }}

                                            </p>

                                        </div>

                                    </div>

                                </a>

                            </div>

                        </div>

                    @endif



                    @php

                        $others_2->shift()

                    @endphp



                    <div class="row entretenimento">

                        @foreach($others_2 as $item)

                            <div class="col-6 col-md-4 col-lg-3">

                                <a href="{{ route('news_detail', [ 'slug' => $item->slug ] )}}">

                                    <div class="card border-0">

                                        <img src="{{ \Illuminate\Support\Facades\Storage::url("posts/{$item->file}") }}" alt="">

                                        <div class="card-body pl-0">

                                            <h5 class="card-title  text-dark">{{ $item->title }}</h5>

                                            <div class="d-flex justify-content-start">

                                                <small>{{ $item->category->title }}</small>

                                                <!-- <img class="ml-2" src="{{ asset("assets/img/icon/compartilhar.png") }}" alt=""> -->

                                            </div>

                                        </div>

                                    </div>

                                </a>

                            </div>

                        @endforeach

                    </div>

                </div>



                <!-- menu lateral -->

                @include('pages.layouts.sections._sidebar')

            </div>

        </div>

    </section>


    @if(isset($popup[0]))
        <div id="myModalPopup" class="modal-popup">
            <span class="close-popup">&times;</span>
            <a href="{{ route('banner_hit', [ 'slug' => $popup[0]->slug ] )}}" target="_blank">
                <img class="modal-popup-content" src="{{ \Illuminate\Support\Facades\Storage::url("banners/{$popup[0]->file}") }}">
            </a>
        </div>
    @endif

@endsection



@section('scripts')

    <script>
        // Get the modal
        var modal = document.getElementById("myModalPopup");

        setTimeout(function() {
            if (modal) {
                modal.style.display = "block";
            }
        }, 3000);

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close-popup")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    </script>

@stop