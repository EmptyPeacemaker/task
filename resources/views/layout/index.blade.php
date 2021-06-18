<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>
        @hasSection('title')
            @yield('title')
        @else
            Задачник
        @endif
    </title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div class="container">
    <div class="row justify-content-end">
        @auth
            <a href="{{route('profile')}}" class="btn m-1 btn-primary col-auto">Профиль</a>
            <a href="{{route('logout')}}" class="btn m-1 btn-primary col-auto">Выход</a>
        @endauth
        @guest
            <a href="{{route('login')}}" class="btn m-1 btn-primary col-auto">Вход</a>
            <a href="{{route('register')}}" class="btn m-1 btn-primary col-auto">Регистрация</a>
        @endguest
    </div>
</div>

@yield('content')

<script src="{{asset('js/app.js')}}"></script>
@yield('script')
</body>
</html>
