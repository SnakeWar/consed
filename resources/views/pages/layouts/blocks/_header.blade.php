<section class="top_link pt-4 d-none d-md-block">

    <div class="container-fluid">

        <div class="row d-flex justify-content-end">
            <div class="col-md-2 d-flex justify-content-end">

                <a class="btn musica" target="_blank" href="https://www.youtube.com/channel/UCPvUFqjcgSQ_CIiZn_DqQMQ"> Youtube

                    <i class="ml-2 fab fa-youtube"></i>

                </a>

            </div>

            <div class="col-md-2 d-flex justify-content-end">

                <a class="btn musica" target="popup"  href="#" onClick="MyWindow=window.open('http://tunein.com/popout/player/s7436','96fm - Ao Vivo','width=600,height=110'); return false;"> Ouça ao vivo

                    <img class="ml-2 " src="{{ asset("assets/img/icon/icon_music.png") }}" alt="">

                </a>

            </div>

            <div class="col-md-4 d-flex align-items-center">

                <form action="{{ route('buscar_noticias') }}" class="d-flex flex-row align-items-center" method="post">

                    @csrf

                    <div class="input-group">

                        <input type="text" name="buscarNoticia" class="form-control" placeholder="Buscar notícia">

                    </div>

                    <button type="submit" class="btn pesquisa ml-2">

                        <img src="{{ asset("assets/img/icon/pesquisa.png") }}" alt="">

                    </button>

                </form>

            </div>

        </div>

    </div>

</section>

<nav class="navbar navbar-expand-lg navbar-light">

    <div class="container-fluid">

        <a class="navbar-brand" href="{{ route('home') }}">

            <img class="ml-4" src="{{ asset("assets/img/logo-96-fm-branca.png") }}" alt="Logo 96FM">

        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

            <img src="{{ asset("assets/img/icon/menu.png") }}" alt="">

        </button>

        <div class="collapse navbar-collapse zoomIn " id="navbarSupportedContent">

            <ul class="navbar-nav ml-auto">

                @foreach($menus as $menu)

                    @if(isset($menu['submenus']))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{!! $menu['title'] !!}</a>
                            <div class="dropdown-menu">
                                @foreach($menu['submenus'] as $submenu)
                                    <a class="dropdown-item" target="{!! $submenu['target'] !!}" {!! isset($submenu['onclick']) ? 'onclick="' . $submenu['onclick'] . '"' : '' !!}  href="{!! $submenu['url'] !!}">{!! $submenu['title'] !!}</a>
                                @endforeach
                            </div>
                        </li>
                    @else
                        <li class="nav-item">

                            <a class="nav-link" target="{!! $menu['target'] !!}" {!! isset($menu['onclick']) ? 'onclick="' . $menu['onclick'] . '"' : '' !!}  href="{!! $menu['url'] !!}">{!! $menu['title'] !!}</a>

                        </li>
                    @endif

                @endforeach

            </ul>

        </div>

    </div>

</nav>


<!-- top_link no mobile -->

<section class="top_link pt-3 d-block d-md-none">

    <div class="container-fluid">

        <div class="row d-flex justify-content-center justify-content-md-around ">

            <div class="col-md-3 d-flex align-items-center mb-3">

                <form action="{{ route('buscar_noticias') }}" class="d-flex flex-row align-items-center" method="post">

                    @csrf

                    <div class="input-group">

                        <input type="text" name="buscarNoticia" class="form-control" placeholder="Buscar notícia">

                    </div>

                    <button type="submit" class="btn pesquisa ml-2">

                        <img src="{{ asset("assets/img/icon/pesquisa.png") }}" alt="">

                    </button>

                </form>

            </div>

            <div class="col-6">

                <a class="btn musica" target="popup" href="#" onClick="MyWindow=window.open('http://centova10.ciclanohost.com.br:6258/stream','96fm - Ao Vivo','width=300,height=50'); return false;">
                    <img class="mr-2" src="{{ asset("assets/img/icon/icon_music.png") }}" alt="">
                    Rádio
                </a>

            </div>

            <div class="col-6">

                <a class="btn musica" target="_blank" href="https://www.youtube.com/channel/UCPvUFqjcgSQ_CIiZn_DqQMQ">
                    <i class="mr-2 fab fa-youtube"></i>
                    Youtube
                </a>

            </div>

        </div>

    </div>

</section>

@include('pages.layouts.sections.top_banner_desktop')