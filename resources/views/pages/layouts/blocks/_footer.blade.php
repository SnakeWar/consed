<footer>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-2">
                <img class="logo" src="{{ asset("assets/img/logo.png") }}" alt="">
            </div>

            @foreach($categories as $category)
                <div class="col-md-1">
                    <ul>
                        @foreach($category as $item)
                            <li>
                                <a href="{{ route('news') . '?category=' . $item['id'] }}">
                                    {{ $item['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach

            <div class="col-md-1 border-left">
                <h5> <a href="">Contato</a></h5>
                <h5><a href="">Publicidade</a></h5>
            </div>
            <div class="col-md-2 ">
                <p>Redes sociais:</p>
                <a href="">
                    <img src="{{ asset("assets/img/icon/facebook-a.png") }}" alt="">
                </a>
                <a href="">
                    <img src="{{ asset("assets/img/icon/twitter.png") }}" alt="">
                </a>
                <a href="">
                    <img src="{{ asset("assets/img/icon/instagram-a.png") }}" alt="">
                </a>
            </div>
        </div>
    </div>
</footer>