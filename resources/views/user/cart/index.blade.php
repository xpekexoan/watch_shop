@extends('user.master')
@section('title')
    Giỏ hàng
@endsection
@section('content')
    <!-- Breadcumb area Start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="page-title">Cart</h1>
                    <ul class="breadcrumb justify-content-center">
                        <li><a href="index.html">Home</a></li>
                        <li class="current"><a href="cart.html">Cart</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- Breadcumb area End -->
    <!-- Main content wrapper start -->
    <div class="main-content-wrapper">
        <div class="cart-area pt--40 pb--80 pt-md--30 pb-md--60">
            <div class="container">
                <div class="cart-wrapper bg--2 mb--80 mb-md--60">
                    <div class="row">
                        <div class="col-12">
                            <!-- Cart Area Start -->
                            <form action="#" class="form cart-form">
                                <div class="cart-table table-content table-responsive">
                                    <table class="table mb--30">
                                        <thead>
                                        <tr>
                                            <th>Hình ảnh</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Màu</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                            <th>Thao tác</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($carts as $item)
                                                <tr class="row-cart">
                                                    <td>
                                                        <a href="product-details.html">
                                                            <img src="{{ asset("storage/".$item->model->image) }}" alt="product"></a>
                                                        </td>
                                                        <td class="wide-column">
                                                            <h3><a href="{{ route('product.detail', ['id' => $item->id]) }}">{{ $item->model->name }}</a></h3>
                                                        </td>
                                                        <td class="cart-product-price"><strong>{{ $item->options->name_color }}</strong></td>
                                                        <td class="cart-product-price"><strong>{{ number_format($item->price) }} đ</strong></td>
                                                        <td>
                                                            <div class="quantity"><input type="number"
                                                                class="quantity-input" name="qty" value="{{ intval($item->qty) }}"
                                                                min="1"></div>
                                                        </td>
                                                        <td class="cart-product-price">
                                                            <strong>{{ number_format($item->qty * $item->price) }} đ</strong>
                                                        </td>
                                                        <td><a class="btn-remove" href="#" data-id="{{$item->rowId}}"><i class="fa fa-times"></i></a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-md-right">
                                        <div class="cart-btn-group">
                                            <a href="#" class="btn btn-medium btn-style-3" id="btn-save">Cập nhật</a></div>
                                    </div>
                                </div>
                            </form><!-- Cart Area End -->
                        </div>
                    </div>
                </div>
                <div class="cart-page-total-wrapper">
                    <div class="row justify-content-end">
                        <div class="col-xl-6 col-lg-8 col-md-10">
                            <div class="cart-page-total bg--dark-3">
                                <h2>Tổng tiền giỏ hàng</h2>
                                <div class="cart-calculator-table table-content table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr class="cart-total">
                                                <th>Tổng tiền</th>
                                                <td><span class="price-ammount">{{ number_format($total) }} đ</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><a href="#" class="btn btn-medium btn-style-3">Thanh toán</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Main content wrapper end -->

@endsection
@section('script')
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.btn-remove').click(function(e) {
            e.preventDefault()
            $(this).closest('tr').remove()
        }) 

        $('#btn-save').click(function(e) {
            e.preventDefault()
            const URL = `{{ route('cart.update') }}`
            let data = []
            $('tr.row-cart').each(function() {
                data.push({
                    rowId: $(this).find('a.btn-remove').data('id'),
                    qty: $(this).find('input[name=qty]').val()
                })
            })
            $.ajax({
                url: URL,
                type: 'POST',
                data: {
                    data: data
                },
                success:function(result) {
                    location.reload()
                },
                error: function(err) {
                    location.reload()
                }
            })
        })
    })
</script>
@endsection