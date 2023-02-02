@extends("layouts.client")
@section("title", "Giỏ hàng")
@section("content")
<div class="container box-cart">
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
    <div class="title-cart">
        <h3>Giỏ hàng</h3>
    </div>
    <form action="{{url('cart/update')}}" method="POST">
        @csrf
        <table class="table table-hover table-bordered table-responsive table-pc" style="background-color: #fff;">
            <thead>
                <tr>
                    <th class="product-remove">STT</th>
                    <th class="product-name">Ảnh</th>
                    <th class="product-name">Tên sản phẩm</th>
                    <th class="product-name">Mã sản phẩm</th>
                    <th class="product-name">Size</th>
                    <th class="product-name">Giá sản phẩm</th>
                    <th class="product-quantity">Số lượng</th>
                    <th class="product-subtotal">Thành tiền</th>
                    <th class="product-subtotal">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $k = 0;
                @endphp
                @foreach (Cart::content() as $row)
                    @php
                        $k++;
                    @endphp
                    <tr>
                        <td>{{$k}}</td>
                        <td><a href=""><img src="{{asset($row->options->thumb)}}" alt="{{$row->name}}" class="ava-cart-product"></a></td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->options->code}}</td>
                        <td>{{$row->options->size}}</td>
                        <td><span class="price-cart" data-price="{{$row->price}}" style="color: #f00;">{{number_format($row->price, 0, ',', '.')}}đ</span></td>
                        <td><input type="number" min="1" data-rowid="{{$row->rowId}}" name="qty[{{$row->rowId}}]" value="{{$row->qty}}" class="qt-cart"></td>
                        <td><span class="sub-total">{{number_format($row->total, 0, ',', '.')}}đ</span></td>
                        <td><a href="{{route('cart.remove', $row->rowId)}}" title="Xóa" style="display: block; text-align: center;">Xóa</a></td>
                    </tr>   
                @endforeach
                <tr>
                    <td colspan="3" class="text-center"><strong>Tổng tiền</strong></td>
                    <td colspan="6" class="text-center"><span class="total-price" style="font-weight:bold; color:#f00;">{{number_format(Cart::total(), 0, ',', '.')}}đ</span></td>
                </tr>
            </tbody>
        </table>
        <div class="cart-act">
            <div class="act-left">
                <a href="{{url('/')}}" class="buy-next" title="Mua tiếp">Mua tiếp</a>
                <a href="{{url('cart/destroy')}}" class="delete-all" title="Xóa giỏ hàng">Xóa giỏ hàng</a>
            </div>
            <div class="act-right">
                <button type="submit" name="btn-update-cart" class="btn-update" title="Cập nhật">Cập nhật</button>
                <a href="{{url('thanh-toan')}}" title="Thanh toán" name="btn-checkout" class="btn-checkout">Thanh toán</a>
            </div>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script async type="text/javascript">
        var $jqe = jQuery.noConflict();
        $jqe(document).ready(function () {
            var qtyCart = $('.qt-cart');
            qtyCart.change(function() {
                let qty = $(this).val();
                let rowid = $(this).data('rowid');
                data = {qty:qty, rowid:rowid, "_token": "{{ csrf_token() }}",};
                $jqe.ajax({
                    url: "{{url('cart/updateAjax')}}",
                    method: "POST",
                    data: data,
                    success: function (data, e) {
                        location.reload();
                        e.preventDefault(); 
                        return false;
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });
                
            });
        });
    </script>
</div>
@endsection