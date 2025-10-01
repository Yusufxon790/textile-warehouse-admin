@extends('admin-panel.dist.layout')
@section('search')
<li class="dropdown pc-h-item">
  <a class="pc-head-link dropdown-toggle me-0" data-pc-toggle="dropdown" href="#" role="button"
    aria-haspopup="false" aria-expanded="false">
    <i data-feather="search"></i>
  </a>
  <div class="dropdown-menu pc-h-dropdown drp-search">
    <form class="px-2 py-1">
      <input type="search" class="ser_income_view form-control !border-0 !shadow-none" placeholder="Search here. . ." />
    </form>
  </div>
</li>
@endsection

@section('title')
    <h3 class="mb-0 font-medium" style="color: rgb(102, 102, 102)" >
        @foreach ($incomes as $income)
            
        @endforeach
            {{ $income->cat_name }}/
            {{ $income->type_name }}/
            {{ $income->color_name }} haqida ma'lumot
    </h3>
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
                   Miqdor
                </th>
                <th style="color: white" >
                   Rulon Soni
                </th>
                <th style="color: white" >Status</th>
                <th style="color: white" >Izoh</th>
                <th style="color: white" >Vaqt</th>
                <th style="color: white;width: 200px;">O'zgartirish/O'chirish</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($incomes as $income)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $income->amount }} kg</td>
                    <td>{{ $income->r_soni }} ta</td>
                    <td>
                       @if ($income->status==1)
                           Qo'shildi
                       @else
                           Olindi
                       @endif
                    </td>
                    <td>{{ $income->desc }}</td>
                    <td>{{ $income->vaqt }}</td>
                    <td>
                        <a href="{{ route('income_view_edit',['id'=>$income->id]) }}" class='btn btn-sm btn-success' ><i class="fas fa-edit" ></i></a>
                        <form action="{{ route('incomes.destroy',['income'=>$income->id]) }}" method="POST" class="d-inline delete-form" >
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger btn-sm submit">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('incomes.index') }}" class="btn btn-danger" >Qaytish</a>
</div>
@endsection