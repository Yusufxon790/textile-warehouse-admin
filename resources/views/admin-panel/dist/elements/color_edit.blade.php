<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Textile</title>
    <link rel="icon" href="{{asset('assets/images/favicon.svg')}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
</head>
<body>
    <div class="container">
        <h2 class="alert alert-secondary text-center" >Maxsulot Ranglari Tahrirlash</h2>
        @if ($message=Session::get('success'))
            <div class="alert alert-success" >
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="d-flex justify-content-center" style="margin-top: 20px;" >
            <form action="{{ route('colors.update',['color'=>$color->id]) }}" method="POST" style="width: 500px;background-color: lightblue;border-radius:10px;" class="p-5" >
                @csrf
                @method('put')
                <label for="">Rangi:</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $color->name }}" >
                @error('name')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror<br>

                <label for="">Kategroiya:</label>
                <select name="cat_id" class="form-control @error('cat_id') is-invalid @enderror" id="cat_select">
                    @foreach ($cats as $cat)
                        <option value="{{ $cat->id }}" @if ($cat->id == $color->cat_id)
                            selected
                        @endif >{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('cat_id')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror<br>

                <label for="">Turi:</label>
                <select name="type_id" class="type_name form-control @error('type_id') is-invalid @enderror" id="type_select">
                        @foreach ($type as $type)
                        <option value="{{ $type->id }}" @if ($type->id == $color->type_id)
                            selected
                        @endif >{{ $type->name }}</option>
                        @endforeach
                </select>
                @error('type_id')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror<br>
                <input type="submit" class="btn btn-warning" value="Saqlash" >
                <a href="{{ route('colors.index') }}" class="btn btn-danger" >Qaytish</a>
              </form>
        </div>
    </div>
</body>
<script src="{{ asset('jquery/jquery.js') }}" ></script>
<script>
    $('#cat_select').on('change', function () {
    let catId = $(this).val(); 

    $.ajax({
        url: '/get-types-by-category/' + catId, 
        type: 'GET',
        success: function (data) {
            $('#type_select').empty();

            data.forEach(function (type) {
                $('#type_select').append('<option value="' + type.id + '">' + type.name + '</option>');
            });
        }
    });
});
</script>
</html>