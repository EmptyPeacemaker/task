@if($deal->executor_id===null)
    <form class="row" method="post" action="{{route('application.add')}}">
        @csrf
        <input type="text" class="d-none" name="deal_id" value="{{$deal->id}}">
        <div class="col">
            <select class="form-select" required name="executor_id">
                <option value selected disabled>Open this select menu</option>
                @foreach(App\Models\User::where('role',1)->get() as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-outline-success col-auto" style="white-space: nowrap" type="submit">Отправить предложение</button>
    </form>
    @if(count($applications)>0)

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Имя</th>
            <th scope="col">Дата предлжения заявки</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($applications as $application)
        <tr>
            <td>{{$application->getExecutor->name}}</td>
            <td>{{$application->created_at->format('H:i d/m/Y')}}</td>
            <td><a href="{{route('application.delete',$application->id)}}" class="btn btn-outline-danger p-0 pt-1" style="border: none"><span class="material-icons">delete</span></a></td>
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
