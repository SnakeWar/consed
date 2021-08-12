@extends('pages.layouts.layout')

@php
    $colors = [
        'BackgroundGreen2',
        'BackgroundOrange',
        'BackgroundYellow',
        'BackgroundIris',
        'BackgroundGreen3',
        'BackgroundRed',
        'BackgroundPurple2',
        'BackgroundGreen',
        'BackgroundBlue',
    ];
@endphp

@php
    $months = [
        'Jan' => 'Jan',
        'Feb' => 'Fev',
        'Mar' => 'Mar',
        'Apr' => 'Abr',
        'Jun' => 'Jun',
        'Jul' => 'Jul',
        'Aug' => 'Ago',
        'Sep' => 'Set',
        'Oct' => 'Oct',
        'Nov' => 'Nov',
        'Dec' => 'Dez',
    ];
@endphp

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/home.css?v=0.2') }}">
@endsection

@section('content')

<section class="search">
    <div class="container">
        <div class="SearchInput">
            <form class="form-inline">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" id="exampleInputAmount" placeholder="Buscar Notícia no Site" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Primeira sessão -->
<section class="FirstSection">
    <div class="container">  
        <div class="row">
            <div class="col-md-8 col-lg-9">
                <div class="PrincipalNew">
                    <a class="stretched-link" href=""></a>
                    <div class="FlexColumn ContentBox JustifyStart">
                        <div class="Category BackgroundYellow MaxWidth100">
                            <p>{{ $highlight->tag->name }}</p>
                        </div>
                        <small class="CardDate White">{{ convertdata_tosite($highlight->publication) }}</small>
                        <h2 class="CardDescription Principal MbDisplayNone White">{{ $highlight->title }}</h2>
                    </div>
                    <img src="{{ asset("storage/news/{$highlight->photo->image}") }}" class="ImageCenter" />
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="FlexColumn SecundariaNew PaddingLineBottom">
                    <a class="stretched-link" href=""></a>
                    <div class="Category Absolute BackgroundBlue">
                        <p>{{ $news[13]->tag->name }}</p>
                    </div>
                    <img src="{{ asset("storage/news/{$news[13]->photo->image}") }}" class="CardImage" />
                    <small class="CardDate PaddingTop5">{{ convertdata_tosite($news[13]->publication) }}</small>
                    <h2 class="CardDescription">{{ $news[13]->title }}</h2>
                </div>
                <div class="FlexColumn SecundariaNew">
                    <a class="stretched-link" href=""></a>
                    <div class="Category Absolute BackgroundBlue">
                        <p>{{ $news[14]->tag->name }}</p>
                    </div>
                    <img src="{{ asset("storage/news/{$news[14]->photo->image}") }}" class="CardImage" />
                    <small class="CardDate PaddingTop5">{{ convertdata_tosite($news[14]->publication) }}</small>
                    <h2 class="CardDescription">{{ $news[14]->title }}</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sessão Informações -->
<section class="InformacoesSection">
    <div class="container">
        <div class="row ">
            <div class="col-12 ">
                <h1 class="SectionTitle White"><img src="{{ asset('assets/img/icon/info-icon.png') }}" class="Icon-title" /> Informações</h1>
                <div class="LineH BackgroundGreen"></div>
            </div>
            <div class="col-12">
                <div class="owl-carousel owl-theme">
                    <div class="Item FlexColumn">
                        <a class="stretched-link" href=""></a>
                        <img src="{{ asset("storage/news/{$news[9]->photo->image}") }}" class="SectionImage" />
                        <div class="FlexColumn">
                            <div class="MarginBottom10">
                                <span class="Category CategoryHigher BackgroundGreen">{{ $news[9]->tag->name }}</span>
                            </div>
                            <span class="CardDate White MarginBottom5">{{ convertdata_tosite($news[9]->publication) }}</span>
                            <span class="SectionCardDescription White Bold">{{ $news[9]->title }}</span>
                        </div>
                    </div>
                    <div class="Item FlexColumn">
                        <a class="stretched-link" href=""></a>
                        <img src="{{ asset("storage/news/{$news[10]->photo->image}") }}" class="SectionImage" />
                        <div class="FlexColumn">
                            <div class="MarginBottom10">
                                <span class="Category CategoryHigher BackgroundGreen">{{ $news[10]->tag->name }}</span>
                            </div>
                            <span class="CardDate White MarginBottom5">{{ convertdata_tosite($news[10]->publication) }}</span>
                            <span class="SectionCardDescription White Bold">{{ $news[10]->title }}</span>
                        </div>
                    </div>
                    <div class="Item FlexColumn">
                        <a class="stretched-link" href=""></a>
                        <img src="{{ asset("storage/news/{$news[11]->photo->image}") }}" class="SectionImage" />
                        <div class="FlexColumn">
                            <div class="MarginBottom10">
                                <span class="Category CategoryHigher BackgroundGreen">{{ $news[11]->tag->name }}</span>
                            </div>
                            <span class="CardDate White MarginBottom5">{{ convertdata_tosite($news[1]->publication) }}</span>
                            <span class="SectionCardDescription White Bold">{{ $news[11]->title }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sessão Gestão Escolar -->
<section class="GestaoEscolarSection">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <span class="SectionTitle Gray Uppercase"><img src="{{ asset('assets/img/icon/gestao-icon.png') }}" class="Icon-title" /> Prêmio gestão escolar</span>
                <div class="LineH BackgroundOrange"></div>
            </div>
            <div class="col-4">
                <img src="{{ asset("storage/news/{$news[4]->photo->image}") }}" class="SectionImageCenter" />
            </div>
            <div class="col-4 pl-4">
                <a class="stretched-link" href=""></a>
                <div class="FlexColumn">
                    <div class="MarginBottom10">
                        <span class="Category CategoryHigher BackgroundOrange">{{ $news[4]->tag->name }}</span>
                    </div>
                    <span class="CardDate Gray MarginBottom5">{{ convertdata_tosite($news[4]->publication) }}</span>
                    <span class="CardTitle Gray MarginBottom15">{{ $news[4]->title }}</span>
                    <span class="SectionCardDescription Gray">{{ $news[4]->description }}</span>
                </div>
            </div>
            <div class="col-4">
                <div class="FlexColumn ColunaNoticias">
                    <div class="FlexRow Flex1 MarginBottom10 JustifyEnd">
                        <a class="stretched-link" href=""></a>
                        <div class="FlexColumn">
                            <span class="CardDate pb-0">{{ convertdata_tosite($news[6]->publication) }}</span>
                            <span class="CardDate pt-1 pb-3">{{ $news[6]->tag->name }}</span>
                            <span class="SectionCardDescription Bold">{{ $news[6]->title }}</span>
                        </div>
                    </div>
                    <div class="FlexRow Flex1 MarginBottom10 JustifyEnd">
                        <a class="stretched-link" href=""></a>
                        <div class="FlexColumn">
                            <span class="CardDate pb-0">{{ convertdata_tosite($news[5]->publication) }}</span>
                            <span class="CardDate pt-1 pb-3">{{ $news[5]->tag->name }}</span>
                            <span class="SectionCardDescription Bold">{{ $news[5]->title }}</span>
                        </div>
                    </div>
                    <div class="FlexRow Flex1 MarginBottom10 JustifyEnd">
                        <a class="stretched-link" href=""></a>
                        <div class="FlexColumn">
                            <span class="CardDate pb-0">{{ convertdata_tosite($news[7]->publication) }}</span>
                            <span class="CardDate pt-1 pb-3">{{ $news[7]->tag->name }}</span>
                            <span class="SectionCardDescription Bold">{{ $news[7]->title }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sessão Base Nacional -->
<section class="BaseNacionalSection">
    <div class="container">
        <div class="row ">
            <div class="col-12 ">
                <h1 class="SectionTitle White"><img src="{{ asset('assets/img/icon/base_nacional-icon.png') }}" class="Icon-title" /> Base Nacional Comum Curricular</h1>
                <div class="LineH BackgroundGreen"></div>
            </div>
            <div class="col-12">
                <div class="owl-carousel owl-theme">
                    <div class="Item FlexColumn">
                        <a class="stretched-link" href=""></a>
                        <img src="{{ asset("storage/news/{$news[12]->photo->image}") }}" class="SectionImage" />
                        <div class="FlexColumn">
                            <div class="MarginBottom10">
                                <span class="Category CategoryHigher BackgroundGreen">{{ $news[12]->tag->name }}</span>
                            </div>
                            <span class="CardDate White MarginBottom5">{{ convertdata_tosite($news[12]->publication) }}</span>
                            <span class="SectionCardDescription White Bold">{{ $news[12]->title }}</span>
                        </div>
                    </div>
                    <div class="Item FlexColumn">
                        <a class="stretched-link" href=""></a>
                        <img src="{{ asset("storage/news/{$news[12]->photo->image}") }}" class="SectionImage" />
                        <div class="FlexColumn">
                            <div class="MarginBottom10">
                                <span class="Category CategoryHigher BackgroundGreen">{{ $news[12]->tag->name }}</span>
                            </div>
                            <span class="CardDate White MarginBottom5">{{ convertdata_tosite($news[12]->publication) }}</span>
                            <span class="SectionCardDescription White Bold">{{ $news[12]->title }}</span>
                        </div>
                    </div>
                    <div class="Item FlexColumn">
                        <a class="stretched-link" href=""></a>
                        <img src="{{ asset("storage/news/{$news[12]->photo->image}") }}" class="SectionImage" />
                        <div class="FlexColumn">
                            <div class="MarginBottom10">
                                <span class="Category CategoryHigher BackgroundGreen">{{ $news[12]->tag->name }}</span>
                            </div>
                            <span class="CardDate White MarginBottom5">{{ convertdata_tosite($news[12]->publication) }}</span>
                            <span class="SectionCardDescription White Bold">{{ $news[12]->title }}</span>
                        </div>
                    </div>
                    <div class="Item FlexColumn">
                        <a class="stretched-link" href=""></a>
                        <img src="{{ asset("storage/news/{$news[12]->photo->image}") }}" class="SectionImage" />
                        <div class="FlexColumn">
                            <div class="MarginBottom10">
                                <span class="Category CategoryHigher BackgroundGreen">{{ $news[12]->tag->name }}</span>
                            </div>
                            <span class="CardDate White MarginBottom5">{{ convertdata_tosite($news[12]->publication) }}</span>
                            <span class="SectionCardDescription White Bold">{{ $news[12]->title }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sessão Noticias por Região -->
<section class="NoticiaRegiaoSection">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 mb-0">
                <h1 class="SectionTitle"><img src="{{ asset('assets/img/icon/noticia-regiao-icon.png') }}" class="Icon-title" /> Noticias por Região</h1>
                <div class="LineH BackgroundGreen"></div>
            </div>

            <!-- REGIAO CENTRO OESTE -->
            <div class="col-4 regiao centro-oeste">
                <div class="head">
                    <div class="region-title">
                        <img src="{{ asset('assets/img/icon/regiao-centro_oeste-icon.png') }}" class="Icon-title" />
                        <h2>Centro Oeste</h2>
                    </div>
                    <div class="principal-new">
                        <a class="stretched-link" href=""></a>
                        <img src="{{ asset('storage/news/ror3na4durti14tcx29cek8je431eb.jpeg') }}" class="w-100 main-img" />
                        <p class="Category mt-3 d-table">{{ $news[4]->tag->name }}</p>
                        <small class="CardDate mb-3">{{ convertdata_tosite($news[12]->publication) }}</small>
                        <h2 class="SectionCardDescription Greay Bold mt-3">{{ $news[12]->title }}</h2>
                    </div>
                </div>
                <div class="other-news mt-5">
                    <div class="new">
                        <a class="stretched-link" href=""></a>
                        <small class="CardDate mb-0">{{ convertdata_tosite($news[12]->publication) }}</small>
                        <p class="CategoryRegion p-0 mb-0 d-table">Distrito Federal</p>
                        <h2 class="SectionCardDescription Greay Bold mt-1">{{ $news[12]->title }}</h2>
                    </div>
                    <div class="new">
                        <a class="stretched-link" href=""></a>
                        <small class="CardDate mb-0">{{ convertdata_tosite($news[12]->publication) }}</small>
                        <p class="CategoryRegion p-0 mb-0 d-table">Distrito Federal</p>
                        <h2 class="SectionCardDescription Greay Bold mt-1">{{ $news[12]->title }}</h2>
                    </div>
                </div>
            </div>

            <!-- REGIAO NORDESTE -->
            <div class="col-4 regiao nordeste">
                <div class="head">
                    <div class="region-title">
                        <img src="{{ asset('assets/img/icon/regiao-nordeste-icon.png') }}" class="Icon-title" />
                        <h2>Nordeste</h2>
                    </div>
                    <div class="principal-new">
                        <a class="stretched-link" href=""></a>
                        <img src="{{ asset('storage/news/ror3na4durti14tcx29cek8je431eb.jpeg') }}" class="w-100 main-img" />
                        <p class="Category mt-3 d-table">{{ $news[4]->tag->name }}</p>
                        <small class="CardDate mb-3">{{ convertdata_tosite($news[12]->publication) }}</small>
                        <h2 class="SectionCardDescription Greay Bold mt-3">{{ $news[12]->title }}</h2>
                    </div>
                </div>
                <div class="other-news mt-5">
                    <div class="new">
                        <a class="stretched-link" href=""></a>
                        <small class="CardDate mb-0">{{ convertdata_tosite($news[12]->publication) }}</small>
                        <p class="CategoryRegion p-0 mb-0 d-table">Bahia</p>
                        <h2 class="SectionCardDescription Greay Bold mt-1">{{ $news[12]->title }}</h2>
                    </div>
                    <div class="new">
                        <a class="stretched-link" href=""></a>
                        <small class="CardDate mb-0">{{ convertdata_tosite($news[12]->publication) }}</small>
                        <p class="CategoryRegion p-0 mb-0 d-table">Rio Grande do Norte</p>
                        <h2 class="SectionCardDescription Greay Bold mt-1">{{ $news[12]->title }}</h2>
                    </div>
                </div>
            </div>

            <!-- REGIAO NORTE -->
            <div class="col-4 regiao norte">
                <div class="head">
                    <div class="region-title">
                        <img src="{{ asset('assets/img/icon/regiao-norte-icon.png') }}" class="Icon-title" />
                        <h2>Norte</h2>
                    </div>
                    <div class="principal-new">
                        <a class="stretched-link" href=""></a>
                        <img src="{{ asset('storage/news/ror3na4durti14tcx29cek8je431eb.jpeg') }}" class="w-100 main-img" />
                        <p class="Category mt-3 d-table">{{ $news[4]->tag->name }}</p>
                        <small class="CardDate mb-3">{{ convertdata_tosite($news[12]->publication) }}</small>
                        <h2 class="SectionCardDescription Greay Bold mt-3">{{ $news[12]->title }}</h2>
                    </div>
                </div>
                <div class="other-news mt-5">
                    <div class="new">
                        <a class="stretched-link" href=""></a>
                        <small class="CardDate mb-0">{{ convertdata_tosite($news[12]->publication) }}</small>
                        <p class="CategoryRegion p-0 mb-0 d-table">Roraima</p>
                        <h2 class="SectionCardDescription Greay Bold mt-1">{{ $news[12]->title }}</h2>
                    </div>
                    <div class="new">
                        <a class="stretched-link" href=""></a>
                        <small class="CardDate mb-0">{{ convertdata_tosite($news[12]->publication) }}</small>
                        <p class="CategoryRegion p-0 mb-0 d-table">Tocantins</p>
                        <h2 class="SectionCardDescription Greay Bold mt-1">{{ $news[12]->title }}</h2>
                    </div>
                </div>
            </div>

            <!-- REGIAO SUL -->
            <div class="col-4 regiao sul">
                <div class="head">
                    <div class="region-title">
                        <img src="{{ asset('assets/img/icon/regiao-sul-icon.png') }}" class="Icon-title" />
                        <h2>Sul</h2>
                    </div>
                    <div class="principal-new">
                        <a class="stretched-link" href=""></a>
                        <img src="{{ asset('storage/news/ror3na4durti14tcx29cek8je431eb.jpeg') }}" class="w-100 main-img" />
                        <p class="Category mt-3 d-table">{{ $news[4]->tag->name }}</p>
                        <small class="CardDate mb-3">{{ convertdata_tosite($news[12]->publication) }}</small>
                        <h2 class="SectionCardDescription Greay Bold mt-3">{{ $news[12]->title }}</h2>
                    </div>
                </div>
                <div class="other-news mt-5">
                    <div class="new">
                        <a class="stretched-link" href=""></a>
                        <small class="CardDate mb-0">{{ convertdata_tosite($news[12]->publication) }}</small>
                        <p class="CategoryRegion p-0 mb-0 d-table">Rio Grande do Sul</p>
                        <h2 class="SectionCardDescription Greay Bold mt-1">{{ $news[12]->title }}</h2>
                    </div>
                    <div class="new">
                        <a class="stretched-link" href=""></a>
                        <small class="CardDate mb-0">{{ convertdata_tosite($news[12]->publication) }}</small>
                        <p class="CategoryRegion p-0 mb-0 d-table">Escola</p>
                        <h2 class="SectionCardDescription Greay Bold mt-1">{{ $news[12]->title }}</h2>
                    </div>
                </div>
            </div>

            <!-- REGIAO SUDESTE -->
            <div class="col-4 regiao sudeste">
                <div class="head">
                    <div class="region-title">
                        <img src="{{ asset('assets/img/icon/regiao-sudeste-icon.png') }}" class="Icon-title" />
                        <h2>Sudeste</h2>
                    </div>
                    <div class="principal-new">
                        <a class="stretched-link" href=""></a>
                        <img src="{{ asset('storage/news/ror3na4durti14tcx29cek8je431eb.jpeg') }}" class="w-100 main-img" />
                        <p class="Category mt-3 d-table">{{ $news[4]->tag->name }}</p>
                        <small class="CardDate mb-3">{{ convertdata_tosite($news[12]->publication) }}</small>
                        <h2 class="SectionCardDescription Greay Bold mt-3">{{ $news[12]->title }}</h2>
                    </div>
                </div>
                <div class="other-news mt-5">
                    <div class="new">
                        <a class="stretched-link" href=""></a>
                        <small class="CardDate mb-0">{{ convertdata_tosite($news[12]->publication) }}</small>
                        <p class="CategoryRegion p-0 mb-0 d-table">Espirito Santo</p>
                        <h2 class="SectionCardDescription Greay Bold mt-1">{{ $news[12]->title }}</h2>
                    </div>
                    <div class="new">
                        <a class="stretched-link" href=""></a>
                        <small class="CardDate mb-0">{{ convertdata_tosite($news[12]->publication) }}</small>
                        <p class="CategoryRegion p-0 mb-0 d-table">Educação</p>
                        <h2 class="SectionCardDescription Greay Bold mt-1">{{ $news[12]->title }}</h2>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Sessão Noticias por Região -->
<section class="EscolaFormacaoSection">
    <div class="container">
        <div class="row">
            <div class="col-12 ">
                <h1 class="SectionTitle White"><img src="{{ asset('assets/img/icon/escola-icon.png') }}" class="Icon-title" /> Escola de Formação</h1>
                <div class="LineH BackgroundGreen"></div>
            </div>
            <div class="col-12">
                <div class="row">
                    @foreach($courses as $course)
                    <div class="col-lg-4">
                        <a href="{{ route('course.show', [ 'slug' => $course['slug'] ] )}}" class="escola-link">
                            <h2 class="CourseDescription m-0">{{ $course->title }}</h2>
                            <img src="{{ asset("storage/courses/{$course->image}") }}" class="w-100 img-escola" />
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
 
<!-- Sessão Agenda da Aprendizagem -->
<section class="AgendaAprendizagemSection">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="SectionTitle"><img src="{{ asset('assets/img/icon/escola-icon.png') }}" class="Icon-title" /> Agenda da aprendizagem</h1>
                <div class="LineH BackgroundGreen"></div>
            </div>
            <div class="col-4">
                <div class="BackgroundOrange White CardTitle Padding17x22 Radius5 Uppercase w-100 text-center MarginBottom15">Temas</div>
                @foreach($themes as $theme)
                    <a href="{{ route('theme.show', [ 'slug' => $theme->slug ] )}}">
                        <div class="FlexRow MarginBottom20">
                            <div class="LineV1 Height BackgroundOrange"></div>
                            <div class="FlexColumn">
                                <span class="CardDate MarginBottom5">{{Carbon\Carbon::parse($theme->published_at)->format('d.m.Y') }}</span>
                                <span class="SectionCardDescription MaxWidtht367 Gray Bold">{{ $theme->title }}</span]>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="col-4">
                <div class="BackgroundPink White CardTitle Padding17x54 Radius5 Uppercase w-100 text-center MarginBottom15">Produtos</div>
                @foreach($products as $product)
                    <a href="{{ route('product.show', [ 'slug' => $product->slug ] )}}">
                        <div class="FlexRow MarginBottom20">
                            <div class="LineV1 Height BackgroundPink"></div>
                            <div class="FlexColumn">
                                <span class="CardDate MarginBottom5">{{Carbon\Carbon::parse($product->ublished_at)->format('d.m.Y') }}</span>
                                <span class="SectionCardDescription MaxWidtht367 Gray Bold">{{ $product->title }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="col-4">
                <div class="BgLightBlue White CardTitle Padding17x54 Radius5 Uppercase w-100 text-center MarginBottom20">
                    Próximos eventos
                </div>
                @foreach($events as $event)
                    <div class="MarginBottom10 {{ $colors[rand(0, sizeof($colors) - 1)] }} JustifyCenter Padding30x18 Radius5">
                        <div class="FlexRow">
                            <div class="EventContainer Padding8x11 ItemsCenter FlexColumn ml-2">
                                <span class="White EventDay">{{ Carbon\Carbon::parse($event->begin_at)->format('d') }}</span>
                                <span class="White EventMonth">{{ $months[Carbon\Carbon::parse($event->begin_at)->format('M')] }}</span>
                            </div>
                            <div class="MaxWidtht217 JustifyCenter ItemsCenter mr-2">
                                <span class="White EventDescription">{{ $event->title }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Sessão Videos -->

<section class="VideosSection">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="SectionTitle White"><img src="{{ asset('assets/img/icon/video-icon.png') }}" class="Icon-title" /> Vídeos</h1>
                <div class="LineH BackgroundGreen"></div>
            </div>
            <div class="col-4 Item">
                <a class="stretched-link" href=""></a>
                <img src="{{ asset('assets/img/example.png') }}" class="SectionImage" />
                <div class="FlexColumn">
                    <div class="MarginBottom10">
                        <span class="Category CategoryHigher BackgroundYellow Gray">Pedagogia</span>
                    </div>
                    <span class="CardDate White MarginBottom5">08.06.2021</span>
                    <span class="SectionCardDescription White Bold">Lorem ipsum dolor sitmet, consectetur adipi. Consectetur gravida nisl mauris convallis massa, tempusiaculis.</span>
                </div>
            </div>
            <div class="col-4 Item">
                <a class="stretched-link" href=""></a>
                <img src="{{ asset('assets/img/example.png') }}" class="SectionImage" />
                <div class="FlexColumn">
                    <div class="MarginBottom10">
                        <span class="Category CategoryHigher BackgroundYellow Gray">Pedagogia</span>
                    </div>
                    <span class="CardDate White MarginBottom5">08.06.2021</span>
                    <span class="SectionCardDescription White Bold">Lorem ipsum dolor sitmet, consectetur adipi. Consectetur gravida nisl mauris convallis massa, tempusiaculis.</span>
                </div>
            </div>
            <div class="col-4 Item">
                <a class="stretched-link" href=""></a>
                <img src="{{ asset('assets/img/example.png') }}" class="SectionImage" />
                <div class="FlexColumn">
                    <div class="MarginBottom10">
                        <span class="Category CategoryHigher BackgroundYellow Gray">Pedagogia</span>
                    </div>
                    <span class="CardDate White MarginBottom5">08.06.2021</span>
                    <span class="SectionCardDescription White Bold">Lorem ipsum dolor sitmet, consectetur adipi. Consectetur gravida nisl mauris convallis massa, tempusiaculis.</span>
                </div>
            </div>
        </div>
        <a class="VideoButton Radius5 BackgroundYellow" href="">Mais Videos</a>
    </div>
</section>


@endsection