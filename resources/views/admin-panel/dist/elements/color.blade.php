@extends('admin-panel.dist.layout')
@section('search')
<li class="dropdown pc-h-item">
  <a class="pc-head-link dropdown-toggle me-0" data-pc-toggle="dropdown" href="#" role="button"
    aria-haspopup="false" aria-expanded="false">
    <i data-feather="search"></i>
  </a>
  <div class="dropdown-menu pc-h-dropdown drp-search">
    <form class="px-2 py-1">
      <input type="search" class="ser_color form-control !border-0 !shadow-none" placeholder="Search here. . ." />
    </form>
  </div>
</li>
@endsection

@section('title')
    <h3 class="mb-0 font-medium alert alert-success  text-center ">Ranglar</h3>
@endsection

@section('content')
<div class="table-responsive">
  @if ($message=Session::get('success'))
    <div class="alert alert-info" >
      <strong>{{ $message }}</strong>
    </div>
  @endif
    <table class="table table-secondary table-striped table-hover table-bordered " >
        <thead class="table-dark" >
            <tr>
                <th style="width: 100px;color: white">No</th>
                <th style="color: white" >Nomi</th>
                <th style="color: white" >Turi</th>
                <th style="color: white" >Kategoriya</th>
                <th style="width: 200px;"><a href="{{ route('colors.create') }}" class="btn btn-primary" >Qo'shish</a></th>
            </tr>
        </thead>
        <tbody class="color_table" >
           @foreach ($colors as $color)
              <tr>
                <td>{{ $loop->iteration }}</td> 
                <td>{{ $color->name }}</td> 
                <td>{{ $color->type_name }}</td> 
                <td>{{ $color->cat_name }}</td> 
                <td>
                  <a href="{{ route('colors.edit',['color'=>$color->id]) }}" class="btn btn-sm btn-warning" ><i class="fas fa-edit" ></i></a>
                </td>
              </tr>           
           @endforeach
        </tbody>
    </table>
</div>
@endsection