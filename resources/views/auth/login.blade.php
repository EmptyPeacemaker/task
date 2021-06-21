@extends('layout.index')
@section('title')
    Главная страница
@endsection
@section('content')

    <form action="{{route('login')}}" method="post" class="card">
        @csrf
        <div class="card-body">
            <h5 class="card-title">Авторизация</h5>
            <h6 class="card-subtitle mb-2 text-danger">{{session()->pull('user')}}</h6>
            <div class="row">
                <div class="col">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email')is-invalid @enderror " id="email"
                           aria-describedby="email-feedback" name="email"
                           @if(\Illuminate\Support\Facades\App::environment('local')) value="test@test.com"
                           @else required @endif>
                    @error('email')
                    <div class="invalid-feedback" id="email-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control @error('password')is-invalid @enderror" id="password"
                           name="password" @if(\Illuminate\Support\Facades\App::environment('local')) value="root"
                           @else required @endif>
                    @error('password')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Авторизоваться</button>
        </div>
    </form>

@endsection
