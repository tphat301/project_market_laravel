@extends("layouts.admin")
@section("title", "Đơn hàng")
@section("content")
<style type="text/css">
    .show-search {
        text-transform:none; 
        font-weight: 500;
        color: rgb(80, 80, 80); 
        background: white; 
        padding: 0px 8px; 
        margin-top: 6px; 
        max-width: 297px;  
        word-wrap: break-word; 
        box-shadow: 0 0 3px rgb(0 0 0 / 30%); 
        border-radius: 4px;
        display: none;
    }
    .show-search.show { display: block; }
    .show-search span { font-weight: 400; }
</style>
<div id="content" class="container-fluid">
    <div class="card">
        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('status')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách đơn hàng</h5>
            <div class="form-search form-inline">
                <form action="#" class="form-group">
                    <input type="text" name="keyword" class="form-control form-search search" placeholder="Tìm kiếm..." value="{{request()->input('keyword')}}">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
                <div class="show-search">Từ khóa <span class="key-s"></span></div>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['state'=>'all'])}}" class="text-info">Tất cả<span class="text-muted"> </span>({{ $state_count[0] }})</a>
                <a href="{{request()->fullUrlWithQuery(['state'=>'is_handle'])}}" class="text-warning">Đang xử lý<span class="text-muted"> ({{ $state_count[1] }})</span></a>
                <a href="{{request()->fullUrlWithQuery(['state'=>'is_transport'])}}" class="text-primary">Đang vận chuyển<span class="text-muted"> ({{ $state_count[2] }})</span></a>
                <a href="{{request()->fullUrlWithQuery(['state'=>'is_success'])}}" class="text-success">Thành công<span class="text-muted"> ({{ $state_count[3] }})</span></a>
                <a href="{{request()->fullUrlWithQuery(['state'=>'order_cancel'])}}" class="text-danger">Hủy đơn hàng<span class="text-muted"> ({{ $state_count[4] }})</span></a>
            </div>
            <form action="{{url('admin/order/action')}}" method="POST">
                @csrf
                <div class="form-action form-inline py-3">
                    <select name="act" class="form-control mr-1" id="act">
                        <option value="">Chọn tác vụ</option>
                        @foreach ($action as $v => $act)
                            <option value="{{$v}}">{{$act}}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="btn-act" value="Áp dụng" class="btn btn-primary" onclick="return confirm('Bạn có muốn thực hiện thao tác này?');">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="checkall">
                            </th>
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
                                    <td>
                                        <input type="checkbox" name="list_check[]" value="{{ $order->id }}">
                                    </td>
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
            </form>
            {{-- pagging --}}
            {{$orders->links()}}
        </div>
    </div>
    <script type="text/javascript">
        const inputSearch = document.querySelector(".search");
        const keySearch = document.querySelector(".show-search .key-s");
        inputSearch.addEventListener("input", function(e)
            {
                // e.preventDefault();
                keySearch.textContent = `"${e.target.value}"`;
                let showSearch = event.target.parentNode.nextElementSibling;
                if(!showSearch.classList.contains("show")) {
                    showSearch.classList.add("show");
                } 
                if(!e.target.value) showSearch.classList.remove("show");
            }
        );

        inputSearch.addEventListener("keydown", function(e)
            {
                let showSearch = event.target.parentNode.nextElementSibling;
                if(e.key == "Escape") showSearch.classList.remove("show");
            }
        );
    </script>
</div>
@endsection