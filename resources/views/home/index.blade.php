@extends("layouts.client")
@section("title", "Market Shop")
@section("content")
<div id="wp-content" class="container-body">
    <div class="counter-sale">
        <h3 class="sale-title">Giảm sốc</h3>
        <i class="fa-solid fa-xmark close-deal"></i>
        <ul class="time">
            <li>
                <span class="text-sale">Ngày</span>
                <span class="number days">0</span>
            </li>
            <li>
                <span class="text-sale">Giờ</span>
                <span class="number hours">0</span>
            </li>
            <li>
                <span class="text-sale">Phút</span>
                <span class="number minutes">0</span>
            </li>
            <li>
                <span class="text-sale">Giây</span>
                <span class="number seconds">0</span>
            </li>
        </ul>
    </div>
    <div class="menu-title">
        <i class="fa-solid fa-bars bar-responsive"></i>
        <div class="menu-content-top">
            <div class="menu-country">
                <div class="name-country"><a href="">Viet Nam</a><i class="fa-solid fa-chevron-down"></i></div>
                <div class="price-country"><a href="">VND</a><i class="fa-solid fa-chevron-down"></i></div>
            </div>
            <div class="menu-user">
                @if (Auth::check())
                    <a href="" class="my-account"><i class="fa-solid fa-user"></i><span>{{Auth::user()->name}}</span></a>
                    <a href="{{ route('logout.user') }}" class="login"><i class="fa-solid fa-lock"></i><span>Đăng xuất</span></a>
                @else
                    <a href="" class="my-account"><i class="fa-solid fa-user"></i><span>Tài khoản</span></a>
                    <a href="{{ route('login.user') }}" class="login"><i class="fa-solid fa-lock"></i><span>Đăng nhập</span></a>
                @endif
                <div class="wp-cart">
                    <a href="{{url('gio-hang')}}" class="cart">
                        <span>
                            <img src="public/img/cart.png" class="p-2 img-cart" alt="cart">
                        </span>
                    </a>
                    <div class="info-cart">
                        <p>Hiện tại có<strong> {{Cart::count()}} sản phẩm</strong> trong giỏ!</p>
                        <ul class="list-cart">
                            @foreach (Cart::content() as $row)
                                <li>
                                    <a href="{{ route('product.detail', $row->options->slug) }}" class="info-cart-left">
                                        <img src="{{asset($row->options->thumb)}}" class="thumb" alt="{{$row->name}}">
                                    </a>
                                    <div class="info-cart-right">
                                        <a href="{{ route('product.detail', $row->options->slug) }}" class="product-name">{{$row->name}}</a>
                                        <div class="box-qty">
                                            <p class="price">Giá: {{number_format($row->price, 0, ',', '.')}}đ</p>
                                            <span class="qty-cart">Số lượng: {{$row->qty}}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="total">
                            <p>Tổng tiền: </p>
                            <p>{{number_format(Cart::total(), 0, ',', '.')}}đ</p>
                        </div>
                        <div class="action-cart">
                            <a href="{{url('gio-hang')}}" class="btn-cart">Giỏ hàng</a>
                            <a href="{{url('thanh-toan')}}" class="btn-checkout">Thanh toán</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="trandmake-shop">
            <div class="title-center">
                <a href="{{url('/')}}" class="name-shop">Market</a>
            </div>
        </div>
        <div class="menu-content-bottom">
            <ul class="mn-left">
                <li><a href="{{ url('/') }}" data-tooltip="Mới">Trang chủ</a></li>
                <li><a href="{{ url('danh-sach-vay-dam') }}" data-tooltip="Mới">Váy đầm</a></li>
                <li><a href="{{ url('danh-sach-ao-thoi-trang') }}" data-tooltip="Mới">Áo thời trang</a></li>
                <li><a href="{{ url('danh-sach-quan-thoi-trang') }}" data-tooltip="Mới">Quần thời trang</a></li>
                <li><a href="{{ url('gioi-thieu') }}" data-tooltip="Mới">Giới thiệu</a></li>
                <li><a href="{{ url('lien-he') }}" data-tooltip="Mới">Liên hệ</a></li>
            </ul>
            <ul class="mn-right">
                <li><a href="" data-hot="Nóng">Tin tức</a></li>
                <li><a href="{{ url('quy-dinh-dang-binh-luan-tai-market-shop') }}" data-hot="Nóng">Khác</a></li>
            </ul>
        </div>
        <!-- MENU TITLE -->
    </div>
    <div class="slider-content">
        <ul class="banner-slider">
            @foreach ($sliders as $slider)
                <li class="banner-item"><a href="#"><img src="{{ asset($slider->thumbnail) }}" alt="banner1"></a></li>
            @endforeach
        </ul>
        <div class="banner-right">
            <a href=""><img src="public/img/Group 33.png" class="img-right-1" alt="Summer Holiday Hits"></a>
            <a href=""><img src="public/img/Group 33 copy.png" class="img-right-2" alt="Spring Holiday Hits"></a>
        </div>
    </div>
    <!-- SLIDER -->

    <div class="address-content">
        <ul class="list-address">
            <li class="address-item"><a href=""><img src="public/img/texas.png" alt="Texas"></a></li>
            <li class="address-item"><a href=""><img src="public/img/aladin.png" alt="Aladin"></a></li>
            <li class="address-item"><a href=""><img src="public/img/samborn.png" alt="Samborn"></a></li>
            <li class="address-item"><a href=""><img src="public/img/aladin.png" alt="Aladin"></a></li>
            <li class="address-item"><a href=""><img src="public/img/texas.png" alt="Texas"></a></li>
        </ul>
    </div>
    <div class="list-shop-banner">
        <div class="list-shop">
            <a href="" class="list-shop-item"><img class="img-shop-men" src="public/img/shopMen.png" alt="Shop Men"><span class="shop-men">Shop men's</span></a>
            <a href="" class="list-shop-item"><img class="img-shop-kid" src="public/img/shopKid.png" alt="Shop Kid"><span class="shop-kid">Shop kids</span></a>
            <a href="" class="list-shop-item"><img class="img-shop-women" src="public/img/shopWomen.png" alt="Shop Women"><span class="shop-women">Shop women's</span></a>
        </div>
    </div>
    <div class="title-arrivals">
        <a href="">SẢN PHẨM NỔI BẬC</a>
    </div>
    <div class="list-arrivals">
        @foreach ($hotProduct as $item)
            <div class="arrivals-item">
                <a href="{{ route('product.detail', $item->slug) }}"><img class="img-arr-1" src="{{ asset($item->thumb) }}" alt="{{ $item->name }}"></a>
                <div class="name-box"><a href="{{ route('product.detail', $item->slug) }}" class="name-arrivals">{{ $item->name }}</a></div>
                <div class="votes">
                    @for ($count = 1; $count <= 5; $count++)
                            @php
                                if($count <= $item->star_votes) {
                                    $color = "color: #ea8948";
                                } else {
                                    $color = "color: #dadada";
                                }
                            @endphp
                            <i class="fa-solid fa-star" style="{{$color}}"></i>
                        @endfor
                    <div class="price">
                        <span class="price-new">{{ number_format($item->price_new, 0, ',', '.') }}đ</span>
                        @if ($item->price_old > 0)
                            <span class="price-old">{{ number_format($item->price_old, 0, ',', '.') }}đ</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
    <div class="banner row">
        <img src="public/img/Banner.png" class="col-12" alt="Banner">
    </div>
    <div class="title-featured">
        <a href="">MẶT HÀNG BÁN CHẠY</a>
    </div>
    <div class="list-product">
        <div class="featured">
            @foreach ($saleGoodProduct as $item)
                <div class="featured-item">
                    <a href="{{ route('product.detail', $item->slug) }}"><img class="img-featured-1" src="{{ asset($item->thumb) }}" alt="{{ asset($item->name) }}"></a>
                    <div class="name-box"><a href="{{ route('product.detail', $item->slug) }}" class="name-featured">{{ $item->name }}</a></div>
                    <div class="votes">
                        @for ($count = 1; $count <= 5; $count++)
                            @php
                                if($count <= $item->star_votes) {
                                    $color = "color: #ea8948";
                                } else {
                                    $color = "color: #dadada";
                                }
                            @endphp
                            <i class="fa-solid fa-star" style="{{$color}}"></i>
                        @endfor
                        <div class="price">
                            <span class="price-new">{{ number_format($item->price_new, 0, ',', '.') }}đ</span>
                            @if ($item->price_old > 0)
                                <span class="price-old">{{ number_format($item->price_old, 0, ',', '.') }}đ</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div id="sub-content" class="container-body row">
    <div class="sub-content-left col-6">
        <h3>Tuần này</h3>
        <div class="list-view-more">
            <div class="view-more-1">
                <p class="view-desc">Giới thiệu đầm xòe và đầm công sở</p>
                <a href="">Xem Thêm</a>
            </div>
            <div class="view-more-2">
                <p class="view-desc">Giới thiệu các mẫu đầm bán chạy</p>
                <a href="">Xem Thêm</a>
            </div>
            <div class="view-more-3">
                <p class="view-desc">Giới thiệu đầm công sở</p>
                <a href="">Xem Thêm</a>
            </div>
        </div>
    </div>
    <div class="sub-content-right col-6">
        <h3>Đăng ký ngay…</h3>
        <p class="sub-content-right-desc">
            Bạn sẽ nhận được các ưu đãi mới nhất về sản phẩm và các sản phẩm mới về sẽ được được cập nhật hàng tuần thông qua hòm thư. Tất cả chỉ có tại Market Shop.
        </p>
        <a href="{{url('register')}}" class="register-customer">Đăng ký</a>
    </div>
    <!-- SUB CONTENT -->
</div>
@endsection