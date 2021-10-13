@extends('user.master')
@section('title')
    Sản phẩm
@endsection
@section('content')
    <div class="shop-area pt--40 pb--80 pt-md--30 pb-md--60">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-lg-2 mb-md--30">
                    <div class="shop-product-wrap row no-gutters grid gridview-3">
                        @foreach($products as $item)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                                <div class="mirora-product mb-md--10">
                                    <div class="product-img"><img src="{{ asset('storage/'.$item->image) }}"
                                                                  alt="Product" class="primary-image" />
                                        @foreach(json_decode($item->image_detail) as $item1)
                                            <img src="{{ asset('storage/'.$item1) }}" alt="Product"
                                                 class="secondary-image" />
                                        @endforeach
                                    </div>
                                    <div class="product-content text-center">
                                        <span>{{ $item->brand->name }}</span>
                                        <h4><a href="{{ route('product.detail', ['id'=>$item->id]) }}">{{ $item->name }}</a></h4>
                                        <span class="money" style="color: #a8741a; font-size: 1.8rem; font-weight: 500;">
                                            {{ number_format($item->price) }} đ
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div><!-- Main Shop wrapper End -->
                    <!-- Pagination Start -->
                    <div class="pagination-wrap mt--15 mt-md--10 justify-content-center">
                        {{-- <ul class="pagination">
                            <li><a href="" class="first">|&lt;</a></li>
                            <li><a href="" class="prev">&lt;</a></li>
                            <li><a href="" class="current">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="" class="next">&gt;</a></li>
                            <li><a href="" class="next">&gt;|</a></li>
                        </ul> --}}
					    {{ $products->links('vendor.pagination.custom') }}
                    </div>
                </div>
                <div class="col-lg-3 order-lg-1">
                    <aside class="shop-sidebar">
                        <div class="search-filter">
                            {{-- <div class="filter-price">
                                <h3 class="filter-heading">Giá</h3>
                                <ul class="filter-list">
                                    <li>
                                        <div class="filter-input filter-radio"><input type="radio"
                                                                                      name="pricerange" id="pricerange-1" checked><label
                                                for="pricerange-1">$55 - $100 (3)</label></div>
                                    </li>
                                    <li>
                                        <div class="filter-input filter-radio"><input type="radio"
                                                                                      name="pricerange" id="pricerange-2"><label
                                                for="pricerange-2">$55 - $200 (2)</label></div>
                                    </li>
                                    <li>
                                        <div class="filter-input filter-radio"><input type="radio"
                                                                                      name="pricerange" id="pricerange-3"><label
                                                for="pricerange-3">$300 - $500 (6)</label></div>
                                    </li>
                                    <li>
                                        <div class="filter-input filter-radio"><input type="radio"
                                                                                      name="pricerange" id="pricerange-4"><label
                                                for="pricerange-4">$700 - $1000 (2)</label></div>
                                    </li>
                                </ul>
                            </div> --}}
                            <div class="filter-categories">
                                <h3 class="filter-heading">Danh mục</h3>
                                
                                <ul class="filter-list">
                                    @foreach ($categories as $item)
                                    <li>
                                        <div class="filter-input filter-checkbox">
                                            <input type="checkbox" name="category1" id="category1">
                                            <label for="category1">{{ $item->name }}</label></div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="filter-brand">
                                <h3 class="filter-heading">Thương hiệu</h3>
                                <ul class="filter-list">
                                    @foreach ($brands as $item)
                                        <li>
                                            <div class="filter-input filter-checkbox">
                                                <input type="checkbox" name="ferragamo" id="ferragamo">
                                                <label for="ferragamo">{{ $item->name }}</label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="filter-color">
                                <h3 class="filter-heading">Màu sắc</h3>
                                <ul class="filter-list">
                                    @foreach ($colors as $item)
                                    <li>
                                        <div class="filter-input filter-checkbox">
                                            <input type="checkbox" name="category1" id="category1">
                                            <label for="category1">{{ $item->name }}</label></div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
@endsection
