@extends("layouts.admin")
@section("title", "Danh sách đánh giá")
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
            <h5 class="m-0 ">Danh sách đánh giá</h5>
            <div class="form-search form-inline">
                <form action="#" class="form-group">
                    <input type="text" name="keyword" class="form-control form-search search" placeholder="Tìm kiếm" value="{{ request()->input('keyword') }}">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
                <div class="show-search">Từ khóa <span class="key-s"></span></div>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{ request()->fullUrlWithQuery(["state"=>"active"]) }}" class="text-primary">Đang hoạt động<span class="text-muted">({{$count_state[0]}})</span></a>
                <a href="{{ request()->fullUrlWithQuery(["state"=>"trash"]) }}" class="text-danger">Vô hiệu hóa<span class="text-muted">({{$count_state[1]}})</span></a>
            </div>
            <form action="{{ url('admin/vote/action') }}" method="POST">
                @csrf
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" id="act" name="act">
                        <option value="">   Thao Tác</option>
                        @foreach ($act as $k => $v)
                            <option value="{{ $k }}">{{ $v }}</option>
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
                            <th scope="col">Tên người đánh giá</th>
                            <th scope="col">Số sao đánh giá</th>
                            <th scope="col">ID của sản phẩm</th>
                            <th scope="col">Nội dung đánh giá</th>
                            <th scope="col">Ngày đánh giá</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($comments->total() > 0)
                            @php
                                $k = 0;
                            @endphp
                            @foreach ($comments as $comment)
                                    @php
                                        $k++;
                                    @endphp
                                <tr>
                                    <td>
                                        <input type="checkbox" name="list_check[]" value="{{ $comment->id }}">
                                    </td>
                                    <td>{{ $k }}</td>
                                    <td><a href="#" style="color:#000;">{{ $comment->fullname }}</a></td>
                                    <td>{{ $comment->rating }}</td>
                                    <td><a href="{{ route('admin.vote.detail', $comment->id) }}" style="color:#007bff;">{{ $comment->product_id }}</a></td>
                                    <td>{{ $comment->content_comment }}</td>
                                    <td>{{ $comment->created_at->format("d/m/Y m:h:s") }}</td>
                                    <td>
                                        <a href="{{ route('admin.vote.delete', $comment->id) }}" class="btn btn-danger btn-sm rounded-0 text-white" onclick="alert('Bạn có muốn xóa đánh giá sản phẩm này không?')" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="9"><p>Không tìm thấy bản ghi</p></td></tr>
                        @endif
                    </tbody>
                </table>
            </form>
            {{-- Paginate --}}
            {{ $comments->links() }}
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