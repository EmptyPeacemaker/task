@extends('layout.index')
@section('title')
    Задачи
@endsection
@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->role===2)
        <a class="btn btn-outline-primary ms-3" href="{{route('deal.add')}}">Новая задача</a>
    @endif
    <div class="p-2">
        <div class="row w-100 p-3">
            @forelse($deals as $deal)
                <a class="card text-start btn m-1 p-0" style="width: 18rem;"
                   href="{{route('deal.show',['deal'=>$deal->id])}}">
                    <div style="height: 210px;"
                         class="overflow-hidden d-flex justify-content-center align-items-center">
                        <img src="{{$deal->img??"/img/none.png"}}" class="card-img-top">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$deal->title}}</h5>
                        <p class="card-text">{{$deal->description}}</p>
                    </div>

                    <div class="card-footer" style="white-space: nowrap">
                        {{$deal->getStatus->title}}
                    </div>
                </a>
            @empty
                <div>
                    Задачи отсутствуют
                </div>
            @endforelse
        </div>
        <div class="mt-1 mb-3">{{$deals->render()}}</div>
    </div>

    <style>
        .card {
            opacity: 0.9;
            transition-property: opacity, border;
            transition-duration: 200ms;
        }

        .card:hover {
            opacity: 1;
            border-color: rgba(0, 0, 0, 0.45);
        }
    </style>


@endsection
