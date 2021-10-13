@extends('admin.master')
@section('title')
Quản lý sản phẩm
@endsection
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex  align-items-center">
              <span class="card-title mr-3">Danh sách</span>
              <a href="{{ route('admin.product.create') }}" class="btn btn-success">Tạo mới</a>
            </div>
          </div>
          <div class="card-body">
            <form method="GET" action="{{ route('admin.product.search') }}">
              <div class="form-row">
                {{-- ID --}}
                <div class="form-group col-md-1">
                  <label for="id">ID:</label>
                  <input type="text" class="form-control" id="id" name="id" value ="{{ $request['id'] ?? '' }}"
                    autocomplete="off">
                </div>
                {{-- Name --}}
                <div class="form-group col-md-2">
                  <label for="name">Tên:</label>
                  <input type="text" class="form-control" id="name" name="name" value ="{{ $request['name'] ?? '' }}"
                    autocomplete="off">
                </div>
                {{-- Category --}}
                <div class="form-group col-md-2">
                  <label for="category">Danh mục:</label>
                  <select id="category" class="form-control" name="id_category">
                    <option value>Tất cả</option>
                    @foreach ($categories as $item)
                      <option value="{{ $item->id }}" @if(isset($request['id_category']) && $request['id_category'] == $item->id) 
                        selected @endif>{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
                {{-- Brand --}}
                <div class="form-group col-md-2">
                  <label for="brand">Thương hiệu:</label>
                  <select id="brand" class="form-control" name="id_brand">
                    <option value>Tất cả</option>
                    @foreach ($brands as $item)
                      <option value="{{ $item->id }}" @if(isset($request['id_brand']) && $request['id_brand'] == $item->id) 
                        selected @endif>{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
                {{-- Status --}}
                <div class="form-group col-md-2">
                  <label for="status">Trạng thái:</label>
                  <select id="status" class="form-control" name="status">
                    <option value="1" selected>Hiển thị</option>
                    <option value="0" @if (isset($request['status']) && $request['status'] == 0) selected @endif>Ẩn</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary align-self-end mb-3 ml-3">Tìm kiếm</button>
              </div>
            </form>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Tên</th>
                  <th scope="col">Giá</th>
                  <th scope="col">Danh mục</th>
                  <th scope="col">Thương hiệu</th>
                  <th scope="col">Trạng thái</th>
                  <th scope="col"width="10%">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $item)
                <tr>
                  <th>{{ $item->id }}</th>
                  <td>{{ $item->name }}</td>
                  <td>{{ number_format($item->price) }} đ</td>
                  <td>{{ $item->category->name }}</td>
                  <td>{{ $item->brand->name ?? "" }}</td>
                  <td>{{ $item->displayStatus() }}</td>
                  <td>
                    <div class="d-flex justify-content-center flex-wrap">
                      <a href="{{ route('admin.product.detail', ['id'=>$item->id]) }}"
                        class="btn btn-info">Xem</a>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <div class="d-flex mt-4 justify-content-between">
              <div>
                <div class="dataTables_info">Total: {{ $products->total() }} entries</div>
              </div>
              <div>
                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                  {{ $products->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</section>
@endsection
