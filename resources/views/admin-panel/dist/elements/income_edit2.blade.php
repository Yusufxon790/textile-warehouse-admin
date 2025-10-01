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
        <h2 class="alert alert-secondary text-center" >Maxsulotdan Miqdor Ayirish</h2>
        @if ($message=Session::get('success'))
            <div class="alert alert-success" >
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <h2 class="text-primary" >
            {{ $income->cat_name }}/
            {{ $income->type_name }}/
            {{ $income->name }}
        </h2>
        <div class="d-flex justify-content-center" style="margin-top: 20px;" >
            <form action="{{ route('income_update2',['id'=>$income->id]) }}" method="POST" style="width: 500px;background-color: lightblue;border-radius:10px;" class="p-5" >
                @csrf
                <input type="hidden" name="cat_id" value="{{ $income->cat_id }}" >
                <input type="hidden" name="type_id" value="{{ $income->type_id }}" >
                <input type="hidden" name="old_amount" value="{{ $income->c_amount }}" >
                <input type="hidden" name="old_cr_soni" value="{{ $income->cr_soni }}" >


                <input type="number" min="1" name="c_amount" class="form-control @error('c_amount') is-invalid @enderror" value="" placeholder="Miqdorini kiriting.." >
                @error('c_amount')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror<br>

                <input type="number" min="1" name="cr_soni" class="form-control @error('cr_soni') is-invalid @enderror" value="" placeholder="Rulon sonini kiriting.." >
                @error('cr_soni')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror<br>

                <input type="text" maxlength="100" name="desc" class="form-control @error('desc') is-invalid @enderror" value="" placeholder="Izoh kiriting.." >
                @error('desc')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror<br>

                <input type="date" name="vaqt" class="form-control @error('vaqt') is-invalid @enderror" value="">
                @error('vaqt')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror<br>

                <input type="submit" class="btn btn-primary" value="Ayirish" >
                <a href="{{ route('incomes.index') }}" class="btn btn-danger" >Qaytish</a>
              </form>
        </div>
    </div>
</body>
<script src="{{ asset('jquery/jquery.js') }}" ></script>

</html>