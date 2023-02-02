@extends("layouts.admin")
@section("title", "Chi tiết đơn hàng")
@section("content")
<div id="content" class="container-fluid">
    <div class="card" style="margin-bottom: 14px">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Thông tin khách hàng</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-checkall table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Mã đơn hàng</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số thoại</th>
                        <th scope="col">Hình thức thanh toán</th>
                        <th scope="col">Ngày đặt hàng</th>
                        <th scope="col">Chú thích</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$order_by_id->fullname}}</td>
                        <td>{{$order_by_id->order_code}}</td>
                        <td>{{$order_by_id->address}}</td>
                        <td>{{$order_by_id->email}}</td>
                        <td>{{$order_by_id->phone}}</td>
                        <td>
                            @if ($order_by_id->payment == "payment_home")
                                <span class="badge badge-primary d-flex justify-content-center" style="font-size: 14px;width: 122px;margin: auto;">
                                    @php        
                                        echo "tại nhà";
                                    @endphp
                                </span>
                            @else
                                <span class="badge badge-danger d-flex justify-content-center" style="font-size: 14px;width: 100px;margin: auto;">
                                    @php        
                                        echo "tại cửa hàng";
                                    @endphp
                                </span>
                            @endif
                        </td>
                        <td>{{$order_by_id->created_at->format('d/m/Y m:h:s')}}</td>
                        <td>
                            {{$order_by_id->note}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Chi tiết đơn hàng</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-checkall table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Ảnh sản phẩm</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Mùa sắc</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Thành tiền</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            @foreach ($thumb_order as $thumb)
                                <img class="img-thumbnail d-block"  src="{{asset($thumb)}}" style="max-width:70px; margin-bottom: 6px;" alt="Ảnh sản phẩm">
                            @endforeach
                        </td>
                        <td>
                            @foreach ($name as $v)
                                <p>{{$v}}</p><br>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($qty_order as $qty)
                                <p>
                                    {{$qty}}
                                </p><br>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($color_product_order as $color)
                                    <img class="img-thumbnail d-block"  src="{{asset($color)}}" style="max-width:70px; margin-bottom: 6px;" alt="Ảnh màu sản phẩm">
                            @endforeach
                        </td>
                        <td>
                            @foreach ($price_order as $price)
                                <p class="text-danger font-weight-bold">{{number_format($price, 0, ",", ".")}}đ</p><br>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($sub_total_price_order as $sub_total_price)
                                <p class="text-danger font-weight-bold">{{number_format($sub_total_price, 0, ",", ".")}}đ</p><br>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-body">
            <table class="table table-checkall table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Tổng số lượng</th>
                        <th scope="col">Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="font-weight-bold">{{ $order_by_id->total_qty }}</span></td>
                        <td><span class="text-danger font-weight-bold">{{number_format($order_by_id->total_price, 0, ",", ".")}}đ</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

