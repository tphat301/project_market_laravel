@extends("layouts.admin")
@section("title", "Thêm trang")
@section("content")
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
        <div class="card-header font-weight-bold">
            Thêm trang mới
        </div>
        <div class="card-body">
            <form action="{{url('admin/page/store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Tiêu đề trang</label>
                    <input class="form-control" type="text" name="title" id="name">
                </div>
                @error('title')
                    <small class="text-danger font-weight-bold">{{$message}}</small>
                @enderror
                <div class="form-group">
                    <label for="author">Người đăng</label>
                    <input class="form-control" type="text" name="author" id="author" value="{{Auth::user()->name}}">
                </div>
                <div class="form-group">
                    <label for="content">Nội dung trang</label>
                    <textarea name="content" class="form-control" id="content" cols="30" rows="5"></textarea>
                </div>
                @error('content')
                    <small class="text-danger font-weight-bold">{{$message}}</small>
                @enderror
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="active" value="active" checked>
                        <label class="form-check-label" for="active">
                            Đang hoạt động
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="wait" value="wait">
                        <label class="form-check-label" for="wait">
                            Chờ duyệt
                        </label>
                    </div>
                </div>
                <button type="submit" name="btn-add" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection