@extends("layouts.client")
@section("title", "Thanh toán")
@section("content")
<div class="container box-cart">
    <div id="main-content-wp" class="checkout-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li style="display: flex;">
                            <i class="fa-solid fa-house" style="padding-right: 6px;"></i>
                            <a href="{{url('/')}}" title="">Trang chủ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <form action="{{url('cart/buyStore')}}" method="POST">
            @csrf
            <div id="wrapper" class="wp-inner clearfix">
                <div class="section" id="customer-info-wp">
                    <div class="section-head">
                        <h1 class="section-title">Thông tin khách hàng</h1>
                    </div>
                    <div class="section-detail">
                        <form action="" name="form-checkout">
                            <div class="form-row clearfix" style="display: flex;">
                                <div class="form-col fl-left">
                                    <label for="fullname">Họ tên</label>
                                    <input type="text" name="fullname" id="fullname">
                                    @error('fullname')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-col fl-right">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email">
                                    @error('email')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row clearfix" style="display: flex;">
                                <div class="form-col fl-left">
                                    <label for="address">Địa chỉ</label>
                                    <input type="text" name="address" id="address">
                                    @error('address')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-col fl-right">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="tel" name="phone" id="phone">
                                    @error('phone')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-col">
                                    <label for="notes">Ghi chú</label>
                                    <textarea name="note"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="section" id="order-review-wp">
                    <div class="section-head">
                        <h1 class="section-title">Thông tin đơn hàng</h1>
                    </div>
                    <div class="section-detail">
                        <table class="shop-table table-responsive" style="display:table;">
                            <thead>
                                <tr>
                                    <td>Sản phẩm</td>
                                    <td>Tổng</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Cart::content() as $row)     
                                    <tr class="cart-item">
                                        <td class="product-name">{{$row->name}}<strong class="product-quantity">x{{$row->qty}}</strong></td>
                                        <td class="product-total">{{number_format($row->total, 0, ',', '.')}}đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="order-total">
                                    <td>Tổng đơn hàng:</td>
                                    <td><strong class="total-price">{{number_format(Cart::total(), 0, ',', '.')}} đ</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div id="payment-checkout-wp">
                            <ul id="payment_methods">
                                <li>
                                    <input type="radio" id="payment-home" name="payment" value="payment_home" checked>
                                    <label for="payment-home">Thanh toán tại nhà</label>
                                </li>
                                <li>
                                    <input type="radio" id="direct-payment" name="payment" value="payment_store">
                                    <label for="direct-payment">Thanh toán tại cửa hàng</label>
                                </li>
                            </ul>
                        </div>
                        <div class="place-order-wp clearfix">
                            <input type="submit" name="btn-buy" id="order-now" value="Đặt hàng">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection