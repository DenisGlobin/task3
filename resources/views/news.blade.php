<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<div class="container-fluid">

    @foreach ($items as $item)
    <div class="text-center">
        <h1>{{ $item->get_title() }}</h1>
    </div>


    <div class="item">
        <p>{{ $item->get_content() }}</p>
        <p>Оригинал статьи <a href="{{ $item->get_permalink() }}">{{ $item->get_title() }}</a></p>
        <p><small>Posted on {{ $item->get_date('j F Y | g:i a') }}</small></p>
    </div>
    @endforeach

</div>

</body>
</html>