<img src="{{$deal->img}}" class="rounded float-end" style="max-width: 50%" alt="...">
<h3>{{$deal->title}}</h3>
<div>{{$deal->description}}</div>
<hr>
<div class="row justify-content-between">
    <div class="col">Время на выполнение:</div>
    <div class="col">{{\Carbon\CarbonInterval::seconds($deal->times)->cascade()->locale('ru')->forHumans()}}</div>
</div>
<div class="row justify-content-between">
    <div class="col">Стоимость:</div>
    <div class="col">{{$deal->price}} ₽</div>
</div>
<hr>
<div class="row justify-content-between">
    <div class="col">Статус:</div>
    <div class="col">{{$deal->getStatus->title}}</div>
</div>

@switch(\Illuminate\Support\Facades\Auth::user()->role)
    @case(1)
    <div class="row justify-content-between">
        <div class="col">Автор:</div>
        <div class="col">{{$deal->getAuthor->name}}</div>
    </div>
    @break
    @case(2)
    <div class="row justify-content-between">
        <div class="col">Исполнитель:</div>
        <div class="col">{{$deal->getExecutor->name?? "Исполнитель не назначен"}}</div>
    </div>
    @break
@endswitch
