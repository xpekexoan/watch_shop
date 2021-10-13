@extends('user.master')
@section('title')
    {{ $product->name }}
@endsection
@section('content')
    <div class="single-products-area section-padding section-md-padding">
        <div class="container">
            <!-- Single Product Start -->
            <section class="mirora-single-product pb--80 pb-md--60">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Tab Content Start -->
                        <div class="tab-content product-details-thumb-large" id="myTabContent-3">
                            <div class="tab-pane fade show active" id="thumb-1">
                                <div class="product-details-img easyzoom">
                                    <a class="popup-btn" href="{{ asset('storage/'.$product->image) }}">
                                        <img src="{{ asset('storage/'.$product->image) }}" alt="product">
                                    </a>
                                </div>
                            </div>
                            @foreach($product->image_detail as $item_image_detail)
                                <div class="tab-pane fade" id="thumb-{{ $loop->index + 2 }}">
                                    <div class="product-details-img easyzoom">
                                        <a class="popup-btn" href="{{ asset('storage/'.$item_image_detail) }}">
                                            <img src="{{ asset('storage/'.$item_image_detail) }}" alt="product">
                                        </a>
                                    </div>
                                </div>
                            @endforeach

                        </div><!-- Tab Content End -->
                        <!-- Product Thumbnail Carousel Start -->
                        <div class="product-details-thumbnail">
                            <div class="thumb-menu product-details-thumb-menu nav-vertical-center"
                                 id="thumbmenu-horizontal">
                                <div class="thumb-menu-item">
                                    <a href="#thumb-1" data-toggle="tab" class="nav-link active">
                                        <img src="{{ asset('storage/'.$product->image) }}" alt="product thumb">
                                    </a>
                                </div>
                                @foreach($product->image_detail as $item_image_detail)
                                    <div class="thumb-menu-item">
                                        <a href="#thumb-{{ $loop->index + 2 }}" data-toggle="tab" class="nav-link">
                                            <img src="{{ asset('storage/'.$item_image_detail) }}" alt="product thumb">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div><!-- Product Thumbnail Carousel End -->
                    </div>
                    <div class="col-lg-6">
                        <!-- Single Product Content Start -->
                        <div class="product-details-content">
                            <div class="product-details-top">
                                <h2 class="product-details-name">{{ $product->name }}</h2>
                                <ul class="product-details-list list-unstyled">
                                    @foreach($brands as $item_brand)
                                        @if($item_brand->id == $product->id_brand)
                                            <li>Thương hiệu: <a href="">{{ $item_brand->name }}</a></li>
                                        @endif
                                    @endforeach
                                    <li>Chống nước: {{ $product->chongnuoc }}</li>
                                    <li>Chất liệu kính: {{ $product->chatlieukinh }}</li>
                                    <li>Chất liệu dây: {{ $product->chatlieuday }}</li>
                                </ul>
                                <div class="product-details-price-wrapper">
                                    <span class="money" id="product-price">
                                        {{ number_format($product->price) }} đ</span>
                                    </div>
                                <div class="mt-3">
                                    <label><sup>*</sup>Màu</label>
                                    <select name="id_color" id="id_color" class="product-color" form="product-cart">
                                        @foreach ($product->colors as $item)
                                            <option value="{{ $item->id_color }}" 
                                                data-price="{{ $item->product->price + $item->price_plus }}"
                                                data-qty="{{ $item->qty }}">
                                            {{ $item->color->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="product-details-bottom">
                                <p class="product-details-availability"><i class="fa fa-check-circle"></i>
                                    Số lượng còn: <span id="product-qty"></span> 
                                </p>
                                <div class="product-details-action-wrapper mb--20">
                                    <form action="{{ route('cart.add', ['id' => $product->id]) }}" method="post" id="product-cart">
                                        @method('post')
                                        @csrf
                                        <div class="product-details-action-top d-flex align-items-center mb--20">
                                            <div class="quantity" style="width: 20rem"><span>Số lượng đặt:</span>
                                                    <input type="number" class="quantity-input" name="qty" id="pro_qty" value="1" min="1">
                                                </div>
                                                <button class="btn btn-medium btn-style-2 add-to-cart">Thêm vào giỏ</button>
                                            </div>
                                        </div>
                                    </form>
                                <p class="product-details-tags">Tags:
                                    @foreach($categories as $item_category)
                                        @if($item_category->id == $product->id_category)
                                            <a href="#">{{$item_category->name}}</a>
                                        @endif
                                    @endforeach

                                <div class="social-share"><a href="facebook.com"
                                                             class="facebook share-button"><i
                                            class="fa fa-facebook"></i><span>Like</span></a><a
                                        href="twitter.com" class="twitter share-button"><i
                                            class="fa fa-twitter"></i><span>Tweet</span></a><a href="#"
                                                                                               class="share share-button"><i
                                            class="fa fa-plus-square"></i><span>Share</span></a></div>
                            </div>
                        </div><!-- Single Product Content End -->
                    </div>
                </div>
            </section>
            
            <section class="product-details-tab bg--dark-4 ptb--80 ptb-md--60">
                <div class="row">
                    <div class="col-12">
                        <ul class="product-details-tab-head nav nav-tab" id="singleProductTab" role="tablist">
                            <li class="nav-item product-details-tab-item"><a
                                    class="nav-link product-details-tab-link active" id="nav-desc-tab"
                                    data-toggle="tab" href="#nav-desc" role="tab" aria-controls="nav-desc"
                                    aria-selected="true">Thông tin sản phẩm</a></li>
                        </ul>
                        <div class="product-details-tab-content tab-content">
                            <div class="tab-pane fade show active" id="nav-desc" role="tabpanel"
                                 aria-labelledby="nav-desc-tab">
                                    <p class="product-details-description">{!! $product->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('script')
<script src="{{ asset('user/js/js.js') }}"></script>
<script>
    $(function() {
        $('select[name=id_color]').change(function() {
            var optionSelected = $("option:selected", this)
            $('#product-qty').text(optionSelected.data('qty'))
            $('#product-price').text(formatCurrency(optionSelected.data('price')))
        })
        
        var item = $('select[name=id_color] > option').eq(0)
        $('#product-qty').text(item.data('qty'))
        $('#product-price').text(formatCurrency(item.data('price')))
    })
</script>
@endsection