@extends("layouts.admin")
@section("title", "Danh sách sản phẩm")
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
        @if (session('success'))     
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('error'))     
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách sản phẩm</h5>
            <div class="form-search form-inline">
                <form action="#" class="form-group">
                    <input type="text" name="keyword" class="form-control form-search search" placeholder="Tìm kiếm..." autocomplete="off">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
                <div class="show-search">Từ khóa <span class="key-s"></span></div>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{ request()->fullUrlWithQuery(['status'=>'active']) }}" class="text-primary">Đang hoạt động<span class="text-muted">({{ $countProduct[0] }})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['status'=>'trash']) }}" class="text-danger">Vô hiệu hóa<span class="text-muted">({{ $countProduct[1] }})</span></a>
            </div>
            <form action="{{ url('admin/product/action') }} " method="POST">
            @csrf
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" id="act" name="act">
                        <option value="">Chọn</option>
                        @foreach ($act as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>
                            <th scope="col">STT</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Mã sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Người tạo</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Ngày tạo</th>
                            @if ($status == 'active' || $status == '')
                                <th scope="col">Tác vụ</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>

                        @if ($products -> total() > 0)
                            @php
                                $k = 0;
                            @endphp
                            @foreach ($products as $product)
                                @php
                                    $k++;
                                @endphp
                                <tr class="">
                                    <td>
                                        <input type="checkbox" name="list_check[]" value="{{ $product->id }}">
                                    </td>
                                    <td>{{ $k }}</td>
                                    <td><img src="{{asset($product->thumb)}}" alt="" style=" max-width: 59px; height: auto; "></td>
                                    <td><p class="text-dark">{{ $product->name }}</p></td>
                                    <td><p class="text-dark">{{ $product->code }}</p></td>
                                    <td><span class="text-danger font-weight-bold">{{ number_format($product->price_new, 0, '.', '.') }}đ</span></td>
                                    <td>
                                        @if ($product->category_product == 'skirt')
                                            Váy đầm
                                        @endif
                                        @if ($product->category_product == 'shirt')
                                            Áo nữ
                                        @endif
                                        @if ($product->category_product == 'trouser')
                                            Quần nữ
                                        @endif
                                        @if ($product->category_product == 'hot_product')
                                            Sản phẩm nổi bậc
                                        @endif
                                        @if ($product->category_product == 'sales_good_product')
                                            Sản phẩm bán chạy
                                        @endif
                                    </td>
                                    <td>{{ $product->author }}</td>
                                    <td>
                                        @if ($product->status == 'active')
                                            <span class="badge badge-success">
                                                Còn hàng ({{$product->qty}})
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                Hết hàng
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $product->created_at->format('m:h:s d/m/Y') }}</td>
                                    @if ($product->status == 'active') 
                                        <td>
                                            <a href="{{ route('admin.product.update', $product->id) }}" class="btn btn-success btn-sm rounded text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                                
                                            <a href="{{ route('admin.product.delete', $product->id) }}" class="btn btn-danger btn-sm rounded text-white" onclick="return confirm('Bạn có muốn xóa sản phẩm?');" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="12"><span>Không tìm thấy bản ghi</span></td></tr>
                        @endif
                    </tbody>
                </table>
            </form>
            {{-- pagging --}}
            {{ $products->links() }}
        </div>
    </div>
    <script type="text/javascript">
        const inputSearch = document.querySelector(".search");
        const keySearch = document.querySelector(".show-search .key-s");
        inputSearch.addEventListener("input", function(e)
            {
                e.preventDefault();
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