@extends('layout.index')
@section('title')
    Главная страница
@endsection
@section('content')

    <form action="{{route('register')}}" method="post" class="card">
        @csrf
        <div class="card-body">
            <h5 class="card-title">Регистрация</h5>
{{--            <h6 class="card-subtitle mb-2 text-muted">Подзаголовок карты</h6>--}}
            <div class="row">
                <div class="col">
                    <label for="name" class="form-label">Имя</label>
                    <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" @if(\Illuminate\Support\Facades\App::environment('local')) value="root" @else required @endif>
                    @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control @error('password')is-invalid @enderror" id="password" name="password" @if(\Illuminate\Support\Facades\App::environment('local')) value="root" @else required @endif>
                    @error('password')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email')is-invalid @enderror " id="email" aria-describedby="email-feedback" name="email" @if(\Illuminate\Support\Facades\App::environment('local')) value="test@test.com" @else required @endif>
                    @error('email')
                    <div class="invalid-feedback" id="email-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="role" class="form-label">Роль</label>
                    <select name="role" class="form-select @error('role')is-invalid @enderror" id="role" @if(!\Illuminate\Support\Facades\App::environment('local')) required @endif>
                        <option value @if(!\Illuminate\Support\Facades\App::environment('local')) selected disabled @endif>Выберите роль</option>
                        <option value="1" @if(\Illuminate\Support\Facades\App::environment('local')) selected @endif>Исполнитель</option>
                        <option value="2">Заказчик</option>
                    </select>
                    @error('role')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </div>
    </form>


@endsection
