@extends('admin-panel.dist.layout')
@section('search')
<li class="dropdown pc-h-item">
  <a class="pc-head-link dropdown-toggle me-0" data-pc-toggle="dropdown" href="#" role="button"
    aria-haspopup="false" aria-expanded="false">
    <i data-feather="search"></i>
  </a>
  <div class="dropdown-menu pc-h-dropdown drp-search">
    <form class="px-2 py-1">
      <input type="search" class="ser form-control !border-0 !shadow-none" placeholder="Search here. . ." />
    </form>
  </div>
</li>
@endsection
@section('title')
    <h3 class="mb-0 font-medium alert alert-success text-center">Kategoriyalar</h3>
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
                <th style="width: 150px;color: white">No</th>
                <th style="color: white" >Nomi</th>
                <th style="width: 200px;"><a href="{{ route('textile.create') }}" class="btn btn-primary" >Qo'shish</a></th>
            </tr>
        </thead>
        <tbody class="cat_table" >
          @foreach($cats as $cat)
          <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $cat->name }}</td>
              <td>
                  <a href="{{ route('textile.edit', ['textile' => $cat->id]) }}" class="btn btn-sm btn-warning">
                      <i class="fas fa-edit"></i>
                  </a>
              </td>
          </tr>
          @endforeach
        </tbody>
    </table>
</div>
@endsection