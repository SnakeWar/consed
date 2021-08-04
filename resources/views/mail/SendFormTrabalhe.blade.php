<html>
    <body>
        <p><strong>Nome:</strong> {{ $name }}</p>
        <p><strong>E-mail:</strong> {{ $email }}</p>
        <p><strong>Telefone:</strong> {{ $phone }}</p>
        <p><strong>Mensagem:</strong> {{ $content }}</p>
        <p><strong>Currículo:</strong><a download="{{$name}}.pdf" href="{{asset("storage/workWithUs/{$file}")}}">Ver</a></p>
    </body>
</html>
