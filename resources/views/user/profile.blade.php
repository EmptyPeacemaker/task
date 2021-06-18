@extends('layout.index')
@section('title')
    Профиль
@endsection
@section('content')

    <div class="card w-50">
        <div class="card-body">
            <h5 class="card-title justify-content-between d-flex align-items-center">
                Профиль
                <div class="btn btn-outline-primary pl-1 pr-1" style="border: none" data-bs-toggle="modal"
                     data-bs-target="#exampleModal">
                    <span class="material-icons">edit</span>
                </div>
            </h5>

            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Имя</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="name"
                           value="{{\Illuminate\Support\Facades\Auth::user()->name}}"
                           style="outline: none">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="email"
                           value="{{\Illuminate\Support\Facades\Auth::user()->email}}"
                           style="outline: none">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="role" class="col-sm-2 col-form-label">Роль</label>
                <div class="col-sm-10">
                    @foreach([1=>'Исполнитель',2=>'Заказчик'] as $id=>$text)
                        @if(\Illuminate\Support\Facades\Auth::user()->role===$id)
                            <input type="text" readonly class="form-control-plaintext" id="role" value="{{$text}}"
                                   style="outline: none">
                        @endif
                    @endforeach

                </div>
            </div>


        </div>
    </div>

    <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="{{route('profile-edit')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Редактирование профиля</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <label for="name" class="form-label">Имя</label>
                        <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name"
                               @if(\Illuminate\Support\Facades\App::environment('local')) value="{{\Illuminate\Support\Facades\Auth::user()->name}}"
                               @else required @endif>
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="form-label">Пароль</label>
                        <input type="password" class="form-control @error('password')is-invalid @enderror" id="password" placeholder="*****"
                               name="password" @if(\Illuminate\Support\Facades\App::environment('local'))
                               @else required @endif>
                        @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email')is-invalid @enderror " id="email"
                               aria-describedby="email-feedback" name="email"
                               @if(\Illuminate\Support\Facades\App::environment('local')) value="{{\Illuminate\Support\Facades\Auth::user()->email}}"
                               @else required @endif>
                        @error('email')
                        <div class="invalid-feedback" id="email-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="role" class="form-label">Роль</label>
                        <select name="role" class="form-select @error('role')is-invalid @enderror" id="role">
                            @foreach([1=>'Исполнитель',2=>'Заказчик'] as $id=>$text)
                                <option value="{{$id}}" @if(\Illuminate\Support\Facades\Auth::user()->role == $id) selected @endif>{{$text}}</option>
                            @endforeach
                        </select>
                        @error('role')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    @if($errors->any())
        <script> (new window.bootstrap.Modal(document.getElementById('exampleModal'))).show()</script>
    @endif
@endsection
