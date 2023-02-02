@extends("layouts.admin")
@section("title", "Dashboard")
@section("content")
<div class="container-fluid py-5">
    <div class="row">
        <div class="col">
            <div class="card text-dark bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐANG XỬ LÝ</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $number_isHandle_order }}</h5>
                    <p class="card-text">Số đơn đang đang xử lý</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG ĐANG VẬN CHUYỂN</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $number_trasport_order }}</h5>
                    <p class="card-text">Số đơn đang vận chuyển</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $number_success_order }}</h5>
                    <p class="card-text">Số đơn thành công</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG HỦY</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $number_trash_order }}</h5>
                    <p class="card-text">Số đơn bị hủy</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">DANH THU BÁN HÀNG</div>
                <div class="card-body">
                    <h5 class="card-title">{{ number_format($total_price_sale, 0, ",", ".") }}đ</h5>
                    <p class="card-text">Tổng doanh thu</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                <div class="card-header">SỐ LƯỢNG NHẬP HÀNG</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $qty_product_of_system }}</h5>
                    <p class="card-text">Tổng doanh thu</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-header">SỐ LƯỢNG XUẤT KHO</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $total_qty_sale }}</h5>
                    <p class="card-text">Số lượng xuất đi</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-dark bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-header">SỐ LƯỢNG TỒN KHO</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $qty_product_of_system - $total_qty_sale }}</h5>
                    <p class="card-text">Tổng doanh thu</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end analytic  -->
    <div class="card">
        <div class="card-header font-weight-bold">
            ĐƠN HÀNG MỚI
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>

                        <th scope="col">STT</th>
                        <th scope="col">Mã đơn hàng</th>
                        <th scope="col">Tên khách hàng</th>
                        <th scope="col">Số diện thoại</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Giá trị</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($orders->total() > 0)
                        @php
                            $k = 0;
                        @endphp
                        @foreach ($orders as $order)
                            @php
                                $k++;
                            @endphp
                            <tr>
                                <td>{{ $k }}</td>
                                <td><a href="{{ route('admin.order.detail', $order->id) }}" style="color: rgb(63, 137, 223);">{{ $order->order_code }}</a></td>
                                <td>{{ $order->fullname }}</td>
                                <td><span class="text-secondary">{{ $order->phone }}</span></td>
                                <td><span class="qty">{{ $order->total_qty }}</span></td>
                                <td><span class="text-danger font-weight-bold">{{number_format($order->total_price, 0, ",", ".")}}đ</span></td>
                                <td>
                                    @if ($order->status_order == 'is_handle')
                                        <span class="badge badge-warning">
                                            @php
                                                echo "Đang xử lý";
                                            @endphp
                                        </span>
                                    @endif
                                    @if ($order->status_order == 'is_transport')
                                        <span class="badge badge-primary">
                                            @php
                                                echo "Đang vận chuyển";
                                            @endphp
                                        </span>
                                    @endif
                                    @if ($order->status_order == 'is_success')
                                        <span class="badge badge-success">
                                            @php
                                                echo "Thành công";
                                            @endphp
                                        </span>
                                    @endif
                                    @if ($order->status_order == 'order_cancel')
                                        <span class="badge badge-danger">
                                            @php
                                                echo "Hủy đơn hàng";
                                            @endphp
                                        </span>
                                    @endif
                                </td>
                                <td class="font-weight-bold">{{ $order->created_at->format('d/m/Y m:h:s') }}</td>
                                @if ($order->status_order !== "order_cancel")
                                    <td>
                                        <a href="{{ route('admin.order.delete', $order->id) }}" onclick="return confirm('Bạn có muốn hủy đơn hàng?');" class="btn btn-danger btn-sm rounded text-white" type="button" data-toggle="tooltip" data-placement="top" title="Hủy đơn hàng"><i class="fa fa-trash"></i></a>
                                    </td> 
                                @else
                                <td></td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="12"><p>Không tìm thấy bản ghi</p></td></tr>
                    @endif
                </tbody>
            </table>
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection