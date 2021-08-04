<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="content-language" content="pt-br">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="{{ (isset($post->description)) ? $post->description : '' }}" />
    <meta name="keywords" content="" />
    <meta name="robots" content="index,follow,noodp">
    <meta name="googlebot" content="index,follow">
    <meta name="subject" content="">
    <meta name="abstract" content="">
    <meta name="topic" content="">
    <meta name="summary" content="">
    <meta property="og:url" content="{{ (isset($post->slug)) ? asset("noticia/{$post->slug}") : '' }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ (isset($post->title)) ? $post->title : '' }}">
    <meta property="og:image" content="{{ (isset($post->file)) ? asset("storage/posts/{$post->file}") : '' }}">
    <meta property="og:description" content="{{ (isset($post->description)) ? $post->description : '' }}">
    <meta property="og:image:alt" content="{{ (isset($post->title)) ? $post->title : '' }}">
    <meta property="og:site_name" content="Portal 96FM">
    <meta property="og:locale" content="pt_BR">
    <meta itemprop="name" content="{{ (isset($post->title)) ? $post->title : '' }}">
    <meta itemprop="description" content="{{ (isset($post->description)) ? $post->description : '' }}">
    <meta itemprop="image" content="{{ (isset($post->file)) ? asset("storage/posts/{$post->file}") : '' }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="{{ (isset($post->title)) ? $post->title : '' }}">
    <meta name="twitter:url" content="{{ (isset($post->slug)) ? asset("noticia/{$post->slug}") : '' }}">
    <meta name="twitter:title" content="{{ (isset($post->title)) ? $post->title : 'Portal 96FM' }}">
    <meta name="twitter:description" content="{{ (isset($post->description)) ? $post->description : '' }}">
    <meta name="twitter:image" content="{{ (isset($post->file)) ? asset("storage/posts/{$post->file}") : '' }}">
    <meta name="msapplication-TileColor" content="#5a3180">
    <meta name="theme-color" content="#5a3180">

    <title>Portal 96FM {{ (isset($post->title)) ? '- ' . $post->title : '' }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/favicon.ico') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/index.css?v=0.1') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;0,500;0,700;0,900;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/owl-carousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/owl-carousel/assets/owl.theme.default.min.css') }}">

    <!-- plugin facebook -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v10.0" nonce="KsVhKFm3"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-173180922-8"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-173180922-8');
    </script>
    
    @yield('css')
</head>