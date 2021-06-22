<form method="post" enctype="multipart/form-data" action="{{route(isset($deal->id)?'deal.save':'deal.create')}}">
    @csrf

    @if(isset($deal->id))
        <input type="text" class="d-none" name="id" value="{{$deal->id}}">

    @else
        <div class="mb-3">
            <label class="form-label" for="img">Превью</label>
            <input type="file" class="form-control @error('img') is-invalid @enderror" id="img" name="img">
            @error('img')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    @endif
    <div class="mb-3">
        <label for="title" class="form-label">Заголовок</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
               maxlength="50"
               value="{{$deal->title??''}}">
        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Краткое описание</label>
        <input class="form-control @error('description') is-invalid @enderror" name="description" id="description"
               rows="1"
               maxlength="150" value="{{$deal->description??''}}">
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="row">
        <div class="mb-3 col">
            <label for="price" class="form-label">Стоимость</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                   min="0" value="{{$deal->price??""}}">
            @error('price')
            <div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3 col">
            <label for="times" class="form-label">Время на выполнение</label>
            <input type="text" class="form-control" id="times"
                   placeholder="{{isset($deal->times)?$deal->getTime():""}}">
            <div class="invalid-feedback hidden" id="times-feedback">Время должно быть больше 1 минуты</div>
            <input type="text" name="times" class="d-none" value="{{$deal->times??""}}">
        </div>
    </div>
    <div class="mb-3">
        <label for="text" class="form-label">Подробное описание</label>
        <textarea class="form-control @error('text') is-invalid @enderror" name="text" id="text" rows="3"
                  maxlength="150">{{$deal->text??""}}</textarea>
        @error('text')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <button type="submit" class="btn btn-outline-success">{{isset($deal->id)?"Сохранить":"Создать"}}</button>
    @if(isset($deal->id))
        <a href="{{route('deal.delete',['deal'=>$deal->id])}}" class="btn btn-outline-danger">Удалить</a>
    @endif
</form>

@section('script')
    <script>
        $('#times').mask('0000-дней 00-часов 00-минут', {reverse: true});
        $('form').submit(function (event) {
            let times = $('#times').val();
            if (times) {
                times = times.split(/\s/).map(el => el.split('-').length === 2 ? el.split('-') : null).filter(el => el).reduce((result, el) => {
                    switch (el[1]) {
                        case 'дней':
                            return result + (el[0] * 60 * 60 * 24)
                        case 'часов':
                            return result + (el[0] * 60 * 60)
                        case 'минут':
                            return result + (el[0] * 60)
                    }
                }, 0)
                if (times > 0) $('[name=times]').val(times)
            }
            if (!$('[name=times]').val()){
                $('#times').addClass('is-invalid');
                $('#times-feedback').show();
                event.preventDefault();
            }
        })
    </script>
@endsection
