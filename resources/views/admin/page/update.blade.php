@extends("layouts.admin")
@section("title", "Cập nhật trang")
@section("content")
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Cập nhật trang
                </div>
                <div class="card-body">
                    <form action="{{route('admin.page.update_store', $page->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên trang</label>
                            <input class="form-control" type="text" name="title" id="name" value="{{$page->title}}">
                        </div>
                        <div class="form-group">
                            <label for="author">Người tạo</label>
                            <input class="form-control" type="text" name="author" id="author" value="{{Auth::user()->name}}">
                        </div>
                        <div class="form-group">
                            <label for="content">Nội dung trang</label>
                            <textarea name="content" class="form-control" id="content" cols="30" rows="5">{!!$page->content!!}</textarea>
                        </div>
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
                        <input type="submit" name="btn_update" class="btn btn-primary" value="Cập nhật">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection