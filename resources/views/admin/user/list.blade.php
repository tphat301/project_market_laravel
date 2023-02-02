@extends("layouts.admin")
@section("title", "Danh sách người dùng")
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
            <h5 class="m-0 ">Danh sách thành viên</h5>
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
                <a href="{{ request()->fullUrlWithQuery(['state'=>'active']) }}" class="text-primary">Đang hoạt động<span class="text-muted"> ({{ $count_user[0] }})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['state'=>'trash']) }}" class="text-danger"> Vô hiệu hóa<span class="text-muted"> ({{ $count_user[1] }}) </span></a>
            </div>
            <form action="{{ url('admin/user/action') }}" method="POST"> 
                @csrf
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" id="act" name="act">
                        <option value="">Chọn tác vụ</option>
                        @foreach ($act as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="btn-act" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="checkall">
                            </th>
                            <th scope="col">STT</th>
                            <th scope="col">Họ tên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Người tạo</th>
                            <th scope="col">Quyền</th>
                            <th scope="col">Tài khoản </th>
                            <th scope="col">Trạng thái </th>
                            <th scope="col">Ngày tạo</th>
                            @if ($state == 'active' || $state == '')
                                <th scope="col">Tác vụ</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->total() > 0)
                            @php
                                $k = 0;
                            @endphp
                            @foreach ($users as $user)
                                @php
                                    $k++;
                                @endphp
                                <tr>
                                    <td>
                                        <input type="checkbox" name="list_check[]" value="{{ $user->id }}">
                                    </td>
                                    <th scope="row">{{ $k }}</th>
                                    <td> {{ $user->name }} </td>
                                    <td> {{ $user->email }} </td>
                                    <td> {{ $user->author }} </td>
                                    <td>
                                        @if ($user->role == 'all')
                                            Toàn quyền
                                        @endif
                                        @if ($user->role == 'post')
                                            Quyền bài viết
                                        @endif
                                        @if ($user->role == 'page')
                                            Quyền trang
                                        @endif
                                        @if ($user->role == 'product')
                                            Quyền sản phẩm
                                        @endif
                                        @if ($user->role == 'order')
                                            Quyền đơn hàng
                                        @endif
                                        @if ($user->role == 'slider')
                                            Quyền slider
                                        @endif
                                        @if ($user->role == 'customer')
                                            Không có quyền
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->level == 1)
                                            Admin
                                        @else
                                            Khách hàng
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->status == 'active') 
                                            Đang hoạt động
                                        @else
                                            Vô hiệu hóa
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('m:h:s d/m/Y') }}</td>
                                    @if ($user->status == 'active')    
                                        <td>
                                            <a href="{{ route('admin.user.update', $user->id) }}" class="btn btn-success btn-sm rounded text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                            @if (Auth::user()->id !== $user->id)
                                                <a href="{{ route('admin.user.delete', $user->id) }}" class="btn btn-danger btn-sm rounded text-white" type="button" onclick="return confirm('Bạn có muốn xóa người dùng?');" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="9"><span>Không tìm thấy bản ghi</span></td></tr>
                        @endif
                    </tbody>
                </table>
            </form>

            {{-- paginate --}}
            {{ $users->links() }}

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