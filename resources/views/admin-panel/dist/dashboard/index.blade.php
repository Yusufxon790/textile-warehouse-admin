@extends('admin-panel.dist.layout')
@section('search')
<li class="dropdown pc-h-item">
  <a class="pc-head-link dropdown-toggle me-0" data-pc-toggle="dropdown" href="#" role="button"
    aria-haspopup="false" aria-expanded="false">
    <i data-feather="search"></i>
  </a>
  <div class="dropdown-menu pc-h-dropdown drp-search">
    <form class="px-2 py-1">
      <input type="search" class="ser_income form-control !border-0 !shadow-none" placeholder="Search here. . ." />
    </form>
  </div>
</li>
@endsection

@section('title')
    <h3 class="mb-0 font-medium alert alert-success  text-center ">Hozirgi Holat</h3>
@endsection

@section('content')
<div class="table-responsive">
  @if ($message=Session::get('success'))
    <div class="alert alert-info" >
      <strong>{{ $message }}</strong>
    </div>
  @endif
    <table class="table table-secondary table-striped table-hover table-bordered w-100 text-nowrap" style="min-width: 1000px;" >
        <thead class="table-dark" >
            <tr>
                <th style="width: 100px;color: white">No</th>
                <th style="color: white" >
                  <select class="form-select income_change_1">
                    <option value="">---</option>
                    <option value="All">Kategoriya(All)</option>
                    @foreach ($cats as $cat)
                      <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                  </select>
                </th>
                <th style="color: white" >
                  <select class="form-select income_change_2">
                    
                  </select>
                </th>
                
                <th style="color: white" >Rangi</th>
                <th style="color: white;width: 100px;" >Miqdor(kg|m)</th>
                <th style="color: white;width: 100px;" >Rulonlar soni</th>
                <th style="color: white" >Summa</th>
                <th style="color: white;width: 200px;">Qo'shish/Ayirish/Ko'rish</th>
            </tr>
        </thead>
        <tbody class="income_table" >
        
        </tbody>
    </table>
    <h2 class="h2" ></h2>
</div>

<div class="sum" >
    <h4 class="alert alert-info shadow-sm mt-3 sum_summa " >Umumiy summa: 0 so'm</h4>
    <h4 class="alert alert-info shadow-sm mt-3 sum_amount " >Mavjud miqdor: 0 kg/m</h4>
    <h4 class="alert alert-info shadow-sm mt-3 sum_r_soni " >Mavjud rulonlar soni: 0 ta</h4>
</div>

@endsection