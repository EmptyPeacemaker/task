@extends('layout.index')
@section('title')
    Заявки
@endsection
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Имя</th>
            <th scope="col">Задача</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($applications as $application)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$application->getDeal->getAuthor->name}}</td>
            <td><a class="link-primary" href="{{route('deal.show',['deal'=>$application->getDeal->id])}}">{{$application->getDeal->title}}</a></td>
            <td>
                @switch($application->status)
                    @case(1)
                    <a href="{{route('application.send.accept',['application'=>$application->id])}}" class="btn btn-outline-success">Принять</a>
                    <a href="{{route('application.send.refuse',['application'=>$application->id])}}" class="btn btn-outline-danger">Отказать</a>
                    @break
                    @case(2)
                    Согласие на предложение отправлено
                    @break
                @endswitch
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

@endsection
