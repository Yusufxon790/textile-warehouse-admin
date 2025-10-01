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
        <h2 class="alert alert-secondary text-center" >Maxsulot Ranglari Qo'shish</h2>
        @if ($message=Session::get('success'))
            <div class="alert alert-success" >
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="d-flex justify-content-center" style="margin-top: 20px;" >
            <form action="{{ route('colors.store') }}" method="POST" style="width: 500px;background-color: lightblue;border-radius:10px;" class="p-5" >
                @csrf
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"  placeholder="Rangi.." value="{{ old('name') }}" >
                @error('name')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror<br>
                <select name="cat_id" class="color_cat_change form-control @error('cat_id') is-invalid @enderror" id="">
                    <option value="">Kategoriya..</option>
                    @foreach ($cats as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>@error('cat_id')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror<br>
                <select name="type_id" class="type_name form-control @error('type_id') is-invalid @enderror" id="">
                    <option value="">Turi: Avval kategoriyani tanlang..</option>
                </select>@error('type_id')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror<br>
                <input type="submit" class="btn btn-success" value="Qo'shish" >
                <a href="{{ route('colors.index') }}" class="btn btn-danger" >Qaytish</a>
              </form>
        </div>
    </div>
</body>
<script src="{{ asset('jquery/jquery.js') }}" ></script>

<script>
    $('.color_cat_change').on('change',function(){
    let value1=$('.color_cat_change').val();
    
    $.ajax({
      url:'{{ route("colors.color_cat_change") }}',
      type:"GET",
      data:{color_cat_change:value1},
      success:function(data){
        $('.type_name').html(data.types);
      },
    })
  })
</script>
</html>