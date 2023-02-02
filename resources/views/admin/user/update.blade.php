@extends("layouts.admin")
@section("title", "Cập nhật người dùng")
@section("content")
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
        <div class="card-header font-weight-bold">
            Cập nhật người dùng
        </div>
        <div class="card-body">
            <form action="{{ route('admin.user.updateStore', $userById->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ $userById->name }}">
                    @error('name')
                        <style>
                            [name="name"]{
                                border: 1px solid rgb(240, 105, 105);
                                outline: 0;
                                box-shadow: 0 0 0 0.1rem rgb(240, 105, 105);
                            }
                        </style>
                        <small class="text-danger font-weight-bold">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{ $userById->email }}" disabled>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" id="password">
                    @error('password')
                        <style>
                            [name="password"]{
                                border: 1px solid rgb(240, 105, 105);
                                outline: 0;
                                box-shadow: 0 0 0 0.1rem rgb(240, 105, 105);
                            }
                        </style>
                        <small class="text-danger font-weight-bold">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm">Xác nhận mật khẩu</label>
                    <input class="form-control" type="password" name="password_confirmation" id="password-confirm">
                    @error('password_confirmation')
                        <style>
                            [name="password_confirmation"]{
                                border: 1px solid rgb(240, 105, 105);
                                outline: 0;
                                box-shadow: 0 0 0 0.1rem rgb(240, 105, 105);
                            }
                        </style>
                        <small class="text-danger font-weight-bold">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    <select name="role" class="form-control" id="">
                        <option value="">Chọn quyền</option>
                        <option value="all">Toàn quyền</option>
                        <option value="product">Quản lý sản phẩm</option>
                        <option value="post">Quản lý bài viết</option>
                        <option value="order">Quản lý đơn hàng</option>
                        <option value="page">Quản lý trang</option>
                        <option value="slider">Quản lý slider</option>
                    </select>
                    @error('role')
                        <style>
                            [name="role"]{
                                border: 1px solid rgb(240, 105, 105);
                                outline: 0;
                                box-shadow: 0 0 0 0.1rem rgb(240, 105, 105);
                            }
                        </style>
                        <small class="text-danger font-weight-bold">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" name="btn-add" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection