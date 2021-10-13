@extends('admin.master')
@section('title')
Quản lý đơn hàng
@endsection
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="d-flex  align-items-center">
                    <span class="card-title mr-3">Chi tiết</span>
                  </div>
                </div>

                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-3">
                          <strong>Mã đơn hàng:</strong>
                        </div>
                        <div class="col-sm-7">
                          {{ $order->id }}
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <strong>Thời gian đặt hàng:</strong>
                        </div>
                        <div class="col-sm-7">
                          {{ $order->order_at }}
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <strong>Trạng thái:</strong>
                        </div>
                        <div class="col-sm-7">
                          @php
                            $item = $order
                          @endphp
                          @include('admin.order.status')
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <strong>Được xử lý bởi:</strong>
                        </div>
                        <div class="col-sm-7">
                          {{ $order->saler->name }}
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-3">
                          <strong>ID người đặt hàng:</strong>
                        </div>
                        <div class="col-sm-7">
                          {{ $order->id_customer }}
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <strong>Người đặt hàng:</strong>
                        </div>
                        <div class="col-sm-7">
                          {{ $order->name }}
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <strong>Số điện thoại:</strong>
                        </div>
                        <div class="col-sm-7">
                          {{ $order->tel }}
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <strong>Địa chỉ giao hàng:</strong>
                        </div>
                        <div class="col-sm-7">
                          {{ $item->fullAddress() }}
                        </div>
                      </div>
                    </div>
                    
                  </div>
                  <br>

                  <div class="row">
                    <div class="col-12 table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Thời gian bảo hành</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Thành tiền</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($order->detail as $item)
                          <tr>
                            <td>{{ $item->product->id }}</td>
                            <td>
                                {{ $item->product->name }}</a>
                            </td>
                            <td>{{ $item->product->warranty }} tháng</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ number_format($item->unit_cost) }} đ</td>
                            <td>{{ number_format($item->getSubTotal()) }} đ</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- /.col -->
                  </div>

                  <div class="row">
                    <!-- accepted payments column -->
                    <!-- /.col -->
                    <div class="col-6">
                      <p class="lead">Tổng tiền</p>

                      <div class="table-responsive">
                        <table class="table">
                          <tr>
                            <th style="width:50%">Tổng thành tiền:</th>
                            <td>{{ number_format($order->total_money) }} đ</td>
                          </tr>
                          <tr>
                            <th>Phí giao hàng:</th>
                            <td>{{ number_format($order->ship_money) }} đ</td>
                          </tr>
                          <tr>
                            <th>Tổng tiền:</th>
                            <td>{{ number_format($order->getTotalMoney()) }} đ</td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>

                  <div class="row no-print">
                    <div class="col-12">
                      <a href="{{ route('admin.order.index') }}" class="btn btn-warning">Trở lại</a>
                      <a href="{{ route('admin.order.print' , ['id' => $order->id]) }}" rel="noopener"
                        target="_blank" class="btn btn-default"><i class="fas fa-print"></i> In hóa đơn</a>
                    </div>
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