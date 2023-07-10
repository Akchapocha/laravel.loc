<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
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
                                <a class="nav-link" href="{{ route('dashboard') }}">Личный кабинет</a>
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
    <div class="col-3">
        {!! form($form) !!}
    </div>
</div>
</body>

<script>
    $(document).ready(function () {
        let post = {
            'id': location.search.replace('?id=', ''),
            '_token': $('[name=_token]').val(),
        };

        let message = sendAjax('{{ route('getDocument') }}', post);
        if (message[0].id) {
            $('[name=id]').val(post.id);
            $('#title').val(message[0].title);
            $('#lastName').val(message[0].lastName);
            $('#firstName').val(message[0].firstName);
            $('#middleName').val(message[0].middleName);
            $('#birthdate').val(message[0].birthdate);
            $('#country').val(message[0].country);
        }
    });

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
