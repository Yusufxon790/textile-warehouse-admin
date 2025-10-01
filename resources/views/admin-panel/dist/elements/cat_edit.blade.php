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
        <h2 class="alert alert-secondary text-center" >Kategoriya Tahrirlash</h2>
        @if ($message=Session::get('success'))
            <div class="alert alert-success" >
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="d-flex justify-content-center" style="margin-top: 20px;" >
            <form action="{{ route('textile.update',['textile'=>$cat->id]) }}" method="POST" style="width: 500px;background-color: lightblue;border-radius:10px;" class="p-5" >
                @csrf
                @method('put')
                <label for="">Kategroiya:</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $cat->name }}" >
                @error('name')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror<br>
                <input type="submit" class="btn btn-warning" value="Saqlash" >
                <a href="{{ route('textile.index') }}" class="btn btn-danger" >Qaytish</a>
              </form>
        </div>
    </div>
</body>
</html>