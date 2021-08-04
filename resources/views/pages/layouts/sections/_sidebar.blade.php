<div class="col-lg-4 noticias">

    <div class="row">

        @if(!empty($poll))
            <a href="/enquete" class="btn btn-enviar btn-enquete text-white mb-3">Acessar Enquete</a>
        @endif

        <div class="col-md-6 col-lg-12 d-none d-sm-block">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="recentes-tab" data-toggle="tab" href="#recentes" role="tab" aria-controls="recentes" aria-selected="false">Mais recentes</a></li>
                <li class="nav-item"><a class="nav-link" id="lidas-tab" data-toggle="tab" href="#lidas" role="tab" aria-controls="lidas" aria-selected="true">Mais lidas</a></li>
                <li class="nav-item"><a class="nav-link" id="comentadas-tab" data-toggle="tab" href="#comentadas" role="tab" aria-controls="comentadas" aria-selected="false">Mais comentadas</a></li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="recentes" role="tabpanel" aria-labelledby="recentes-tab">
                    <ul class="">
                        @foreach($recent_posts as $top_post )
                            <li class="border-bottom pb-4 mt-3"><a href="{{ route('news_detail', [ 'slug' => $top_post->slug ]) }}">{{ $top_post->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-pane fade" id="lidas" role="tabpanel" aria-labelledby="lidas-tab">
                    <ul class="">
                        @foreach($top_hits as $top_post )
                            <li class="border-bottom pb-4 mt-3"><a href="{{ route('news_detail', [ 'slug' => $top_post->slug ]) }}">{{ $top_post->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-pane fade" id="comentadas" role="tabpanel" aria-labelledby="comentadas-tab">
                    <ul class="">
                        @foreach($top_comments as $top_post )
                            <li class="border-bottom pb-4 mt-3"><a href="{{ route('news_detail', [ 'slug' => $top_post->slug ]) }}">{{ $top_post->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-12">

            <div class="music">

                <a target="popup" href="#" onClick="MyWindow=window.open('http://tunein.com/popout/player/s7436','96fm - Ao Vivo','width=600,height=110'); return false;">Ouça ao vivo

                    <img class="ml-3" src="{{ asset("assets/img/icon/icon_music.png") }}">

                </a>

            </div>



            @if(isset($banners[0]))

                <a href="{{ route('banner_hit', [ 'slug' => $banners[0]->slug ] )}}" target="_blank">

                    <img class="mt-3 w-100 d-none d-md-block" src="{{ \Illuminate\Support\Facades\Storage::url("banners/{$banners[0]->file}") }}" alt="">

                    <img class="mt-3 w-100 d-block d-lg-none" src="{{ \Illuminate\Support\Facades\Storage::url("banners/" . ($banners[0]->file_mobile ? $banners[0]->file_mobile : $banners[0]->file)) }}" alt="">

                </a>

            @endif

        </div>

        <hr>

        @if(isset($videos[0]))
            <div class=" col-md-6 col-lg-12 noticias-destaques">
                <div class="card">
                    <div class="d-flex justify-content-between mt-3 _mais">
                        <h1 class="pl-2">Vídeos</h1>
                    </div>
                    <div class="destaque card mb-4">
                        <a href="{{ isset($videos[0]['src']) ? $videos[0]['src'] : $videos->src }}" target="_blank">
                            <img style="object-fit: cover;height: 265px;" class="w-100" src="{{ isset($videos[0]['thumb']) ? $videos[0]['thumb'] : $videos[0]->getThumb() }}" alt="">
                            <div style="background: linear-gradient( 360deg, rgba(90, 49, 128, 0.9) 0%, rgb(90 49 128 / 1%) 100%)" class="card-body">
                                <p class="mt-1">{{  isset($videos[0]['title']) ? htmlspecialchars_decode($videos[0]['title']) : $videos[0]->title }}</p>
                            </div>
                        </a>
                    </div>
                    @php
                        is_array($videos) ? array_shift($videos) : $videos->shift()
                    @endphp
                    <div class="card-body videos">
                        @foreach($videos as $video)
                            <a href="{{ isset($video['src']) ? $video['src'] : $video->src }}" target="_blank">
                                <div class="media">
                                    <img style="height: 95px; object-fit: cover;" class="mr-2" src="{{ isset($video['thumb']) ? $video['thumb'] : $video->getThumb() }}" alt="">
                                    <div class="media-body">
                                        <h5 class="mt-0">{{ isset($video['title']) ? htmlspecialchars_decode($video['title']) : $video->title }}</h5>
                                    </div>
                                </div>
                            </a>
                            @if(!$loop->last)
                            <hr class="mt-3 mb-3">
                            @endif
                        @endforeach
                        @php
                            $count = is_array($videos) ? count($videos) : $videos->count();
                        @endphp
                        @if($count >= 3)
                            <div class="d-flex justify-content-end  mt-2">
                                <a href="{{ route('videos') }}">Mais vídeos <img src="{{ asset("assets/img/icon/icon_li.png") }}" alt=""></a>
                            </div>
                        @endif
                    </div>
                </div>
                @if(isset($banners[1]))
                    <a href="{{ route('banner_hit', [ 'slug' => $banners[1]->slug ] )}}" target="_blank">
                        <img class="mt-3 w-100 d-none d-md-block" src="{{ \Illuminate\Support\Facades\Storage::url("banners/{$banners[1]->file}") }}" alt="">
                        <img class="mt-3 w-100 d-block d-lg-none" src="{{ \Illuminate\Support\Facades\Storage::url("banners/" . ($banners[1]->file_mobile ? $banners[1]->file_mobile : $banners[1]->file)) }}" alt="">
                    </a>
                @endif
            </div>
        @endif

        @if(!empty($blogs))
        <div class=" col-md-6 col-lg-12 opinioes d-none d-sm-block">
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
        </div>
        @endif

        <div class=" col-md-6 col-lg-12 noticias-destaques">
            @if(isset($banners[2]))
                <a href="{{ route('banner_hit', [ 'slug' => $banners[2]->slug ] )}}" target="_blank">
                    <img class="mt-3 w-100 d-none d-md-block" src="{{ \Illuminate\Support\Facades\Storage::url("banners/{$banners[2]->file}") }}" alt="">
                    <img class="mt-3 w-100 d-block d-lg-none" src="{{ \Illuminate\Support\Facades\Storage::url("banners/" . ($banners[2]->file_mobile ? $banners[2]->file_mobile : $banners[2]->file)) }}" alt="">
                </a>
            @endif

            <div class="card mt-5 p-3">

                <h1>Newsletter</h1>

                <h4>

                    Cadastre-se para receber as novidades direto no seu whatsapp.

                </h4>



                @if(session()->has('success'))

                    <div class="box-body">

                        <div class="alert alert-success">

                            {{ session()->get('success') }}

                        </div>

                    </div>

                @endif

                @if(session()->has('fail'))

                    <div class="box-body">

                        <div class="alert alert-error">

                            {{ session()->get('fail') }}

                        </div>

                    </div>

                @endif



                <form action="{{ route('newsletter') }}" method="post">

                    @csrf

                    <div class="input-group mb-3 @error('email') has-error @enderror">

                        <input type="text" class="form-control" name="email" id="newsletter-input" placeholder="Cadastre seu whatsapp " aria-label="Cadastre seu whatsapp " aria-describedby="basic-addon2">

                        @error('email')

                            <span class="help-block"><strong>{{ $message }}</strong></span>

                        @enderror

                        <div class="input-group-append">

                            <button class="input-group-text" id="basic-addon2" type="submit">

                                <img src="{{ asset("assets/img/icon/setinha.png") }}" alt="">

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <div class=" col-md-6 col-lg-12 noticias-destaques mt-1 mb-5">

            <a href="https://96fm.maxmeio.com/banner/pinga-fogo" target="_blank">

                <img class="mt-3 w-100" src="https://96fm.maxmeio.com/storage/banners/ofr0ayd0hr2lt2vukmxez2krwa907c.jpeg" alt="">

            </a>

        </div>

    </div>

</div>

@section('css')
    <style>
        .btn-enquete{
            background-color: #93338a;
            border-radius: 15px;
            padding: 8px 40px;
            text-transform: uppercase;
            display: table;
            margin: 2rem auto 0;
            transition: 0.6s;
        }
    </style>
@endsection