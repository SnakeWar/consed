@extends('pages.layouts.layout')



@section('content')



    <section id="news_detail">

        <div class="container-fluid">

            <div class="row noticias d-flex justify-content-center">

                <div class="col-lg-8">

                    @include('pages.layouts.sections.top_banner_mobile')

                    <div class="row mt-md-5 noticia_detalhes">

                        <div class="col-md-12">

                            <h1>{{ $page->title }}</h1>



                            @if(!empty($page->file))

                                <img class="w-100" src="{{ \Illuminate\Support\Facades\Storage::url("pages/{$page->file}") }}" alt="">

                            @endif



                            <div class="d-flex justify-content-between mt-3 mb-2">

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



                            {!! $page->content !!}

                        </div>

                    </div>

                </div>

                @include('pages.layouts.sections._sidebar')

            </div>

        </div>

    </section>



@endsection