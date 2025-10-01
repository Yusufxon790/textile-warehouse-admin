@extends('admin-panel.dist.layout')
@section('title')
<h3 class="alert alert-success text-center" >Statistika</h3>
@endsection

@section('content')

    <form action="" class="d-flex" >
        <div>
            <label for="" class="text-dark fw-bold" >Kategoriya</label>
            <select name="" id="cat_id" class="form-select" >
                <option value="">---</option>
                @foreach ($cats as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mx-4" >
            <label for="" class="text-dark fw-bold" >Turi</label>
            <select name="" id="type_id" class="form-select" >
                
            </select>
        </div>
        <div>
            <label for="" class="text-dark fw-bold" >Holati</label>
            <select name="" id="status_id" class="form-select" >
                <option value="">---</option>
                <option value="1">Kirim</option>
                <option value="0">Chiqim</option>
            </select>
        </div>
        <div class="mx-4" >
            <label for="" class="text-dark fw-bold" >Kun bo'yicha xisobot</label>
            <input type="date" id="date_id" class="form-control" >
        </div>
        <div>
            <label for="" class="text-dark fw-bold" >Oy bo'yicha xisobot</label>
           <input type="month" id="month_id" class="form-control" >
        </div>
    </form>

    <div class="table-responsive my-2">
        @if ($message=Session::get('success'))
          <div class="alert alert-info" >
            <strong>{{ $message }}</strong>
          </div>
        @endif
        <h4 class="title_date " ></h4>
          <table class="table table-secondary table-striped table-hover table-bordered w-100 text-nowrap" style="min-width: 1000px;" >
              <thead class="table-dark" >
                  <tr>
                      <th style="width: 100px;color: white">No</th>
                      <th style="color: white" >
                        Kategoriya
                      </th>
                      <th style="color: white" >
                          Turi
                      </th>
                      <th style="color: white" >Rangi</th>
                      <th style="color: white" >Holati</th>
                      <th style="color: white;width: 100px;" >Miqdor(kg|m)</th>
                      <th style="color: white;width: 100px;" >Rulonlar soni</th>
                      <th style="color: white" >Narxi(KG)</th>
                      <th style="color: white" >Summa</th>
                  </tr>
              </thead>
              <tbody class="statistic_table" >
              
              </tbody>
          </table>

        </div>
        <div class="sum" >
          <h4 class="alert alert-info shadow-sm mt-3 sum_summa " >Umumiy summa: 0 so'm</h4>
          <h4 class="alert alert-info shadow-sm mt-3 sum_amount " >Mavjud miqdor: 0 kg/m</h4>
          <h4 class="alert alert-info shadow-sm mt-3 sum_r_soni " >Mavjud rulonlar soni: 0 ta</h4>
      </div>
@endsection