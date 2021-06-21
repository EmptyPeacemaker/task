<form method="post" action="{{route('deal.save')}}">
    @csrf
    <input type="text" class="d-none" name="id" value="{{$deal->id}}">
    <div class="mb-3">
        <label for="title" class="form-label">Загаловок</label>
        <input type="text" class="form-control" id="title" name="title" maxlength="50" value="{{$deal->title}}">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Краткое описание</label>
        <textarea class="form-control" name="description" id="description" rows="1"
                  maxlength="150">{{$deal->description}}</textarea>
    </div>
    <div class="row">
        <div class="mb-3 col">
            <label for="price" class="form-label">Стоимость</label>
            <input type="number" class="form-control" id="price" name="price" min="0" value="{{$deal->price}}">
        </div>
        <div class="mb-3 col">
            <label for="time" class="form-label">Вреня на выполнение</label>
            <input type="text" class="form-control" id="time"
                   placeholder="{{\Carbon\CarbonInterval::seconds($deal->times)->cascade()->locale('ru')->forHumans()}}">
            <div class="invalid-feedback hidden" id="time-feedback">Время должно быть больше 1 минуты</div>
            <input type="text" name="time" class="d-none">
        </div>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Подробное описание</label>
        <textarea class="form-control" name="text" id="description" rows="3"
                  maxlength="150">{{$deal->text}}</textarea>
    </div>
    <button type="submit" class="btn btn-outline-success">Сохранить</button>
</form>
@section('script')
    <script>
        $('#time').mask('0000-дней 00-часов 00-минут', {reverse: true});
        $('form').submit(function (event) {
            let time = $('#time').val();
            if (time) {
                time = time.split(/\s/).map(el => el.split('-').length === 2 ? el.split('-') : null).filter(el => el).reduce((result, el) => {
                    switch (el[1]) {
                        case 'дней':
                            return result + (el[0] * 60 * 60 * 24)
                        case 'часов':
                            return result + (el[0] * 60 * 60)
                        case 'минут':
                            return result + (el[0] * 60)
                    }
                }, 0)
                if (time > 0) $('[name=time]').val(time)
                else {
                    $('#time').addClass('is-invalid');
                    $('#time-feedback').show();
                    event.preventDefault();
                }
            }
        })
    </script>
@endsection
