@extends('layout.index')
@section('title')
    Задача
@endsection
@section('content')
    <div class="card text-center">
        <div class="card-header">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <div class="btn nav-link" id="nav-short-tab" data-bs-toggle="tab" data-bs-target="#nav-short"
                     role="tab" aria-controls="nav-short">Кратко
                </div>
                <div class="btn nav-link " id="nav-description-tab" data-bs-toggle="tab"
                     data-bs-target="#nav-description"
                     role="tab" aria-controls="nav-description">Подробное описание
                </div>
                @if(\Illuminate\Support\Facades\Auth::user()->role===2)
                    @if($deal->executor_id===null)
                        <div class="btn nav-link" id="nav-edit-tab" data-bs-toggle="tab"
                             data-bs-target="#nav-edit"
                             role="tab" aria-controls="nav-edit">Редактирование
                        </div>
                    @endif
                    <div class="btn nav-link active" id="nav-executor-tab" data-bs-toggle="tab"
                         data-bs-target="#nav-executor"
                         role="tab" aria-controls="nav-executor">Исполнитель
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content text-start" id="nav-tabContent">
                <div class="tab-pane fade" id="nav-short" role="tabpanel" aria-labelledby="nav-short-tab">
                    @include('user.deal.module.short')
                </div>
                <div class="tab-pane fade" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">
                    @include('user.deal.module.description')
                </div>
                @if($deal->author_id==\Illuminate\Support\Facades\Auth::id())
                    @if($deal->executor_id===null)
                        <div class="tab-pane fade" id="nav-edit" role="tabpanel" aria-labelledby="nav-edit-tab">
                            @include('user.deal.module.edit')
                        </div>
                    @endif
                    <div class="tab-pane fade show active" id="nav-executor" role="tabpanel"
                         aria-labelledby="nav-executor-tab">
                        @include('user.deal.module.executor')
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{--    <div class="card text-start btn m-1 p-0">--}}
    {{--        <div class="card-"></div>--}}
    {{--        <div style="height: 210px;"--}}
    {{--             class="overflow-hidden d-flex justify-content-center align-items-center">--}}
    {{--            <img src="{{$deal->img}}" class="card-img-top">--}}
    {{--        </div>--}}
    {{--        <div class="card-body">--}}
    {{--            <h5 class="card-title">{{$deal->title}}</h5>--}}
    {{--            <p class="card-text">{{$deal->description}}</p>--}}
    {{--        </div>--}}
    {{--        <div class="card-footer" style="white-space: nowrap">--}}
    {{--            {{$deal->getStatus->title}}--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection
