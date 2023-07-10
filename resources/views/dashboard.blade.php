<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Личный кабинет</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col mt-3">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('welcome') }}">На главную</a>
                            </li>
                            @auth()
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('create') }}">Новый документ</a>
                            </li>
                            @endauth
                            <li class="nav-item">
                                {!! form($logout) !!}
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    @if($documents)
        <div class="row">
            <div class="col">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Документ</th>
                        <th scope="col">ФИО</th>
                        <th scope="col">Дата рождения</th>
                        <th scope="col">Место рождения</th>
                        @can('editing')
                            <th scope="col"></th>
                            <th scope="col"></th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($documents as $document)
                        <tr>
                            <th scope="row">{{ $document->id }}</th>
                            <td>{{ $document->title }}</td>
                            <td>{{ $document->lastName }} {{$document->firstName}} {{$document->middleName}}</td>
                            <td>{{ date('d-m-Y', strtotime($document->birthdate)) }}</td>
                            <td>{{ $document->country }}</td>
                            @can('editing')
                                <td>
                                    <button type="button" id="{{ $document->id }}">Удалить</button>
                                </td>
                                <td>
                                    <a href="{{ route('edit') }}/?id={{ $document->id }}">
                                        <button type="button" id="{{ $document->id }}">Редактировать</button>
                                    </a>
                                </td>
                            @endcan
                        </tr>
                    @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    @endif
</div>

</body>

<script>
    $('button:contains("Удалить")').on('click', function () {
        let post = {
            'id': $(this).attr('id'),
            '_token': $('[name=_token]').val(),
        };

        // console.log($(this).parent().parent());
        let message = sendAjax('{{ route('delete') }}', post);
        if (message !== '') {
            alert(message);
            $(this).parent().parent().remove();
        }
    })

    function sendAjax(url, post, async = false) {
        let response = [];
        $.ajax({
            type: 'POST',
            async: async,
            url: url,
            data: post,
            dataType: 'json',
            success: function (data) {
                if (data) {
                    response = data;
                }
            }
        });
        return response;
    }
</script>

</html>
