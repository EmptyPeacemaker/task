@extends('layout.index')
@section('title')
    Задача
@endsection
@section('content')
    <div class="card text-center">
        <div class="card-header">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @if(isset($deal->id))
                    <div class="btn nav-link active" id="nav-short-tab" data-bs-toggle="tab" data-bs-target="#nav-short"
                         role="tab" aria-controls="nav-short">Кратко
                    </div>
                    <div class="btn nav-link " id="nav-description-tab" data-bs-toggle="tab"
                         data-bs-target="#nav-description"
                         role="tab" aria-controls="nav-description">Подробное описание
                    </div>
                    @if(auth()->user()->role===1 && $deal->executor_id===auth()->id())
                        <div class="btn nav-link" id="nav-author-tab" data-bs-toggle="tab"
                             data-bs-target="#nav-author"
                             role="tab" aria-controls="nav-author">Автор
                        </div>
                    @endif
                @endif
                @if(auth()->user()->role===2 && (!isset($deal->id) || $deal->author_id===auth()->id()))
                    @if(!isset($deal->id) || $deal->executor_id===null)
                        <div class="btn nav-link" id="nav-edit-tab" data-bs-toggle="tab"
                             data-bs-target="#nav-edit"
                             role="tab" aria-controls="nav-edit">{{isset($deal->id)?"Редактирование":"Создание"}}
                        </div>
                    @endif
                    @if(isset($deal->id))
                        <div class="btn nav-link" id="nav-executor-tab" data-bs-toggle="tab"
                             data-bs-target="#nav-executor"
                             role="tab" aria-controls="nav-executor">Исполнитель
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content text-start" id="nav-tabContent">
                @if(isset($deal->id))
                    <div class="tab-pane fade show active" id="nav-short" role="tabpanel" aria-labelledby="nav-short-tab">
                        @include('user.deal.module.short')
                    </div>
                    <div class="tab-pane fade" id="nav-description" role="tabpanel"
                         aria-labelledby="nav-description-tab">
                        @include('user.deal.module.description')
                    </div>
                    @if(auth()->user()->role===1 && $deal->executor_id===auth()->id())
                        <div class="tab-pane fade" id="nav-author" role="tabpanel"
                             aria-labelledby="nav-author-tab">
                            @include('user.deal.module.author')
                        </div>
                    @endif
                @endif
                @if(auth()->user()->role===2 && (!isset($deal->id) || $deal->author_id===auth()->id()))
                    @if(!isset($deal->id) || $deal->executor_id===null)
                        <div class="tab-pane fade " id="nav-edit" role="tabpanel"
                             aria-labelledby="nav-edit-tab">
                            @include('user.deal.module.edit')
                        </div>
                    @endif
                    @if(isset($deal->id))
                        <div class="tab-pane fade " id="nav-executor" role="tabpanel"
                             aria-labelledby="nav-executor-tab">
                            @include('user.deal.module.executor')
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </div>

@endsection
