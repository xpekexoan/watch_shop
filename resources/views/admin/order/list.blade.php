@extends('admin.master')
@section('title')
Quản lý đơn hàng
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
              {{-- <a href="{{ route('admin.blog.create') }}" class="btn btn-success">Create new</a> --}}
            </div>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Tên Người đặt hàng</th>
                  <th scope="col">Số điện thoại</th>
                  <th scope="col">Địa chỉ</th>
                  <th scope="col">Thời gian đặt hàng</th>
                  <th scope="col">Tổng tiền</th>
                  <th scope="col">Trạng thái</th>
                  <th scope="col">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($orders as $item)
                <tr>
                  <th>{{ $item->id }}</th>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->tel }}</td>
                  <td>{{ $item->fullAddress() }}</td>
                  <td>{{ $item->order_at }}</td>
                  <td>{{ number_format($item->getTotalMoney()) }} đ</td>
                  <td>
                    @include('admin.order.status')
                  </td>
                  <td class="d-flex justify-content-center flex-wrap">
                    @if ($item->status == $OrderClass::CONFIRMING)
                    <a href="{{ route('admin.order.detail', ['id'=>$item->id]) }}"
                      class="btn btn-info">Xử lý</a>
                    @else
                    <a href="{{ route('admin.order.detail', ['id'=>$item->id]) }}"
                      class="btn btn-info">Xem</a>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex mt-4 justify-content-between">
              <div>
                <div class="dataTables_info">Total: {{ $orders->total() }} entries</div>
              </div>
              <div>
                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                  {{ $orders->links() }}
                </div>
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