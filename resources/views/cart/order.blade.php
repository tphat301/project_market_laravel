@extends("layouts.client")
@section("title", "Đặt hàng thành công")
@section("content")
<div id="main-content-wp" class="cart-page box-cart container">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li style="display: flex;">
                        <i class="fa-solid fa-house" style="padding-right: 6px;"></i>
                        <a href="{{url('/')}}" title="Trang chủ">Trang chủ</a> <span id="a"></span><span id="b"></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <h3 id="notication" style="text-align: center;font-size: 25px;color: #cd1818;font-weight: bold;">Cám ơn quý khách đã đặt hàng trên hệ thống của chúng tôi</h3>
            <h3 id="notication" style="font-size: 17px; text-align: center;color: #cd1818;font-weight: bold;">Đội ngũ chăm sóc khách hàng sẽ sớm liên hệ với quý khách để xác nhận đơn hàng</h3>
            <h4 class="order-code">MÃ ĐƠN: <strong>{{$code_order}}</strong></h4>
            <h4 class="title-order" style="margin-top: 14px;margin-bottom: 7px;display: inline-block;background: #f0d4d4;padding: 3px 7px;">Thông tin khách hàng</h4>
            <div class="table-responsive">
                <table class="table table-bordered bg-white">
                    <thead>
                        <tr>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Email</th>
                            <th scope="col">Số điện thoại</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align:left; padding: 10px;">{{$name_customer}}</td>
                            <td style="text-align:left; padding: 10px">{{$address_customer}}</td>
                            <td style="text-align:left; padding: 10px;">{{$email_customer}}</td>
                            <td style="text-align:left; padding: 10px;">{{$phone_customer}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <h4 class="title-order" style="margin-top: 14px;margin-bottom: 7px;display: inline-block;background: #f0d4d4;padding: 3px 7px;">Thông tin đơn hàng:</h4>
            <div class="table-responsive text-center">
                <table class="table table-bordered bg-white">
                    <thead>
                        <tr>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Màu sắc</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Size</th>
                            <th scope="col">Giá tiền</th>
                            <th scope="col">Thành tiền</th>
                        </tr>
                    </thead>
                    <style>
                        tbody tr td p{
                            padding-bottom: 90px;
                            display: block;
                            text-align: center;
                        }
                        #home {
                            margin-top: 17px;
                            text-align: center;
                        }
                            #home a:hover {
                            transform: scale(1.1);
                            background: #b4addd;
                            color: black;
                        }

                        .title-total {
                            display: block;
                            text-align: center;
                        }

                        .total {
                            color:#f00;
                            font-weight: bold;
                            display: block;
                            text-align: center;
                        }
                    </style>
                    <tbody>
                            <tr>
                                <td style="text-align:left; padding: 10px;" scope="col">
                                    @foreach ($name_empty as $v)
                                        <p>{{$v}}</p>
                                    @endforeach
                                </td>
                                <td style="text-align:left; padding: 10px;" scope="col">
                                    @foreach ($color_product as $item)
                                        <img src="{{asset($item)}}" style="width:50px; height:auto; display:block; margin:0 auto; padding-bottom: 12px;">
                                    @endforeach
                                </td>
                                <td style="text-align:left; padding: 10px;" scope="col">
                                    @foreach ($qty_empty as $v)
                                        <p>{{$v}}</p>
                                    @endforeach
                                </td>
                                <td style="text-align:left; padding: 10px;" scope="col">
                                    @foreach ($size as $v)
                                        <p>{{$v}}</p>
                                    @endforeach
                                </td>
                                <td style="text-align:left; padding: 10px;" scope="col">
                                    @foreach ($price_empty as $v)
                                        <p>{{number_format($v, 0, ",", ".")}}đ</p>
                                    @endforeach
                                </td>
                                <td style="text-align:left; padding: 10px;" scope="col">
                                    @foreach ($sub_total_empty as $v)
                                        <p>{{number_format($v, 0, ",", ".")}}đ</p>
                                    @endforeach
                                </td>
                            </tr>
                                
                            <tr>
                                <td colspan="3" style="text-align:left; padding: 10px;"><span class="title-total">Tổng tiền</span></td>
                                <td colspan="1" style="text-align:left; padding: 10px;"><span class="total">{{number_format($total_price, 0, ",", ".")}}đ</span></td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection



