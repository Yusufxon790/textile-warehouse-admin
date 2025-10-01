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
        <h2 class="alert alert-secondary text-center" >Maxsulot Miqdorini Tahrirlash</h2>
        @if ($message=Session::get('success'))
            <div class="alert alert-success" >
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="d-flex justify-content-center" style="margin-top: 20px;" >
            <form action="{{ route('income_view_update',['id'=>$income->id]) }}" method="POST" style="width: 500px;background-color: lightblue;border-radius:10px;" class="p-5" >
                @csrf
                <input type="hidden" name="page_id" value="{{ $income->id }}" >
                <input type="hidden" name="color_id" value="{{ $income->color_id }}" >
                <label for="">Miqdor:</label>
                <input type="number" min="1" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ $income->amount }}" >
                @error('amount')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror<br>
                <label for="">Rulon soni:</label>
                <input type="number" min="1" name="r_soni" class="form-control @error('r_soni') is-invalid @enderror" value="{{ $income->r_soni }}" >
                @error('r_soni')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror<br>
                <label for="">Status:</label>
                <select name="status" class="form-select @error('status') is-invalid @enderror" id="">
                    @if ($income->status==1)
                        <option value="1" selected>Qo'shildi</option>
                        <option value="0">Olindi</option>
                    @else
                        <option value="1">Qo'shildi</option>
                        <option value="0" selected>Olindi</option>
                    @endif
                </select>
                @error('status')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror<br>
                <label for="">Izoh:</label>
                <input type="text" name="desc" class="form-control @error('desc') is-invalid @enderror" value="{{ $income->desc }}" >
                @error('desc')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror<br>
                <label for="">Vaqt:</label>
                <input type="date" name="vaqt" class="form-control @error('vaqt') is-invalid @enderror" value="{{ $income->vaqt }}" >
                @error('vaqt')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror<br>


                <input type="submit" class="btn btn-warning" value="Saqlash" >
                <a href="{{ route('incomes.index') }}" class="btn btn-danger" >Qaytish</a>
              </form>
        </div>
    </div>
</body>
<script src="{{ asset('jquery/jquery.js') }}" ></script>

</html>