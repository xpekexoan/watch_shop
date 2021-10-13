<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Hóa đơn</title>

  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
</head>

<body>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <!-- Main content -->
                  <div class="invoice p-3 mb-3">
                    <div class="row">
                      <div class="col-12">
                        <h4>
                          <i class="fas fa-globe"></i> Cửa hàng đồng hồ.
                          <small class="float-right">Thời gian: {{ now() }}</small>
                        </h4>
                      </div>
                      <!-- /.col -->
                    </div>
                    <div class="row">
                      <div class="col-sm-5">
                        <div class="row">
                          <div class="col-sm-5">
                            <strong>ID đơn hàng:</strong>
                          </div>
                          <div class="col-sm-3">
                            {{ $order->id }}
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-5">
                            <strong>Thời gian đặt hàng:</strong>
                          </div>
                          <div class="col-sm-7">
                            {{ $order->order_at }}
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-5">
                            <strong>Địa chỉ giao hàng:</strong>
                          </div>
                          <div class="col-sm-7">
                            {{ $order->fullAddress() }}
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-5 ml-5">
                        <div class="row">
                          <div class="col-sm-5">
                            <strong>Tên người đặt hàng:</strong>
                          </div>
                          <div class="col-sm-7">
                            {{ $order->name }}
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-5">
                            <strong>Số điện thoại:</strong>
                          </div>
                          <div class="col-sm-7">
                            {{ $order->tel }}
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
                              <td>{{ $item->product->name }}</td>
                              <td>{{ $item->product->warranty }}</td>
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
                              <th>Phí giao hàng</th>
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
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </section>

</body>

<script>
  window.addEventListener("load", window.print());
</script>

</html>