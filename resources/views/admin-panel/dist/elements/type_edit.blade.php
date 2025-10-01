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
        <h2 class="alert alert-secondary text-center" >Maxsulot Turlari Tahrirlash</h2>
        @if ($message=Session::get('success'))
            <div class="alert alert-success" >
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="d-flex justify-content-center" style="margin-top: 20px;" >
            <form action="{{ route('types.update',['type'=>$type->id]) }}" method="POST" style="width: 500px;background-color: lightblue;border-radius:10px;" class="p-5" >
                @csrf
                @method('put')
                <label for="">Turi:</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $type->name }}" >
                @error('name')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror<br>
                <label for="">Narxi:</label>
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ $type->price }}" >
                @error('price')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror<br>
                <label for="">Kategroiya:</label>
                <select name="cat_id" class="form-control @error('cat_id') is-invalid @enderror" id="">
                    @foreach ($cats as $cat)
                        <option value="{{ $cat->id }}" @if ($cat->id == $type->cat_id)
                            selected
                        @endif >{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('cat_id')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror<br>
                <input type="submit" class="btn btn-warning" value="Saqlash" >
                <a href="{{ route('types.index') }}" class="btn btn-danger" >Qaytish</a>
              </form>
        </div>
    </div>
</body>
</html>