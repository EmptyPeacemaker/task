@if($deal->executor_id===null)
    @if(count($executors)>0)
        <form class="row" method="post" action="{{route('application.add')}}">
            @csrf
            <input type="text" class="d-none" name="deal_id" value="{{$deal->id}}">
            <div class="col">
                <select class="form-select" required name="executor_id">
                    <option value selected disabled>Выберите исполнителя</option>
                    @foreach($executors as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-outline-success col-auto" style="white-space: nowrap" type="submit">Отправить
                предложение
            </button>
        </form>
    @else
        <div>Вы отправить предложение вем доступным исполнителям</div>
    @endif
    @if(count($applications)>0)

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Имя</th>
                <th scope="col">Дата предложения заявки</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($applications as $application)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">{{$application->getExecutor->name}}</div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">{{$application->created_at->format('H:i d/m/Y')}}</div>
                    </td>
                    <td>
                        @switch($application->status)
                            @case(1)
                            <div class="d-flex align-items-center">
                                <a href="{{route('application.delete',$application->id)}}"
                                   class="btn btn-outline-danger p-0 pt-1" style="border: none"><span
                                        class="material-icons">delete</span></a>
                            </div>
                            @break
                            @case(2)
                            <div class="d-flex align-items-center">
                                Исполнитель согласился на предложения.
                                <a href="{{route('application.select',['application'=>$application->id,'user'=>$application->executor_id])}}"
                                   class="btn btn-outline-primary" style="border: none">Выбрать его</a>
                            </div>
                            @break
                            @case(3)
                            @default
                            Исполнитель отказался от предложения
                            @break
                        @endswitch
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endif


{{--@if(is_array($executor))--}}
{{--<form action="" class="row">--}}
{{--</form>--}}
{{--@else--}}
{{--123--}}
{{--@endif--}}
