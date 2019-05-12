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
            <h1>Новости</h1>
        </div>

        @foreach ($items as $item)
            <div class="item">
                <h2><a href="{{ url('news') . '/' . $item->get_id(true) }}">{{ $item->get_title() }}</a></h2>
                <p>{!! $item->get_description() !!}</p>
                <p><small>Опубликовано: {{ $item->get_date('j F Y | g:i a') }}</small></p>
            </div>
        @endforeach

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                @if ($page == 0)
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                @elseif ($page > 0)
                    <?php $previos = (int) $page - 1; ?>
                    <li class="page-item">
                        <a class="page-link" href="{!! url('/p=') . $previos !!}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                @endif

                <?php
                    $uperPageBar = $page + 3;
                    $difference = $feedsCount - $page;
                    if ($difference < 3) {
                        $uperPageBar = $difference;
                    }
                    $lowerPageBar = 0;
                    $difference = $page - 3;
                    if ($difference > 0) {
                        $lowerPageBar = $difference;
                    }
                ?>
                @for ($i = $lowerPageBar; $i <= $uperPageBar; $i++)
                    @if ($i == $page)
                        <li class="page-item disabled">
                            <a class="page-link" href="{!! url('/p=') . $i !!}">{!! $i + 1 !!}</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{!! url('/p=') . $i !!}">{!! $i + 1 !!}</a>
                        </li>
                    @endif
                @endfor

                @if ($page == $feedsCount)
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                @elseif ($page < $feedsCount)
                    <?php $next = (int) $page + 1; ?>
                    <li class="page-item">
                        <a class="page-link" href="{!! url('/p=') . $next !!}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>