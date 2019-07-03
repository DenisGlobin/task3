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

        <div class="text-center">
            <h1>{{ $item->get_title() }}</h1>
        </div>

        <div class="item">
            <p>{!! $item->get_content() !!}</p>
            <strong>Оригинал статьи <a href="{{ $item->get_permalink() }}">{{ $item->get_title() }}</a></strong>
            <div class="row">
                <div class="col">
                    <p><small>Опубликовано: {{ $item->get_date('j F Y | g:i a') }}</small></p>
                </div>
                <div class="col">
                    <p style="text-align: right"><small>Просмотров: {{ $visited }}</small></p>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row justify-content-md-center">
            <div class="col-md-auto">
                <a href="{!! url('/p=0') !!}">
                    <button type="button" class="btn btn-outline-primary">На главную</button>
                </a>
            </div>
        </div>
    </div>

</body>
</html>