@extends("layouts.admin")
@section("title", "Thêm sản phẩm")
@section("content")
<div id="content" class="container-fluid">
    <div class="card">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
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
        <div class="card-header font-weight-bold">
            Thêm sản phẩm
        </div>
        <div class="card-body">
            <form action="{{ url('admin/product/add_store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="form-group col-3">
                                <label for="name">Tên sản phẩm</label>
                                <input class="form-control" type="text" name="name" id="name">
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
                            <div class="form-group col-3">
                                <label for="fabric-material">Chất liệu vải</label>
                                <input class="form-control" type="text" name="fabric_material" id="fabric-material">
                                @error('fabric_material')
                                    <style>
                                        [name="fabric_material"]{
                                            border: 1px solid rgb(240, 105, 105);
                                            outline: 0;
                                            box-shadow: 0 0 0 0.1rem rgb(240, 105, 105);
                                        }
                                    </style>
                                    <small class="text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-3">
                                <label for="code">Mã sản phẩm</label>
                                <input class="form-control" type="text" name="code" id="code" value="{{ request()->input('code') }}">
                                @error('code')
                                    <style>
                                        [name="code"]{
                                            border: 1px solid rgb(240, 105, 105);
                                            outline: 0;
                                            box-shadow: 0 0 0 0.1rem rgb(240, 105, 105);
                                        }
                                    </style>
                                    <small class="text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-3">
                                <label for="trandmake ">Thương hiệu</label>
                                <input class="form-control" type="text" name="trandmake" id="trandmake">
                                @error('trandmake')
                                    <style>
                                        [name="trandmake"]{
                                            border: 1px solid rgb(240, 105, 105);
                                            outline: 0;
                                            box-shadow: 0 0 0 0.1rem rgb(240, 105, 105);
                                        }
                                    </style>
                                    <small class="text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-3">
                                <label for="price-old">Giá cũ</label>
                                <input class="form-control" type="text" name="price_old" id="price-old">
                            </div>
                            <div class="form-group col-3">
                                <label for="price-new">Giá mới</label>
                                <input class="form-control" type="text" name="price_new" id="price-new">
                                @error('price_new')
                                    <style>
                                        [name="price_new"]{
                                            border: 1px solid rgb(240, 105, 105);
                                            outline: 0;
                                            box-shadow: 0 0 0 0.1rem rgb(240, 105, 105);
                                        }
                                    </style>
                                    <small class="text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="color">Màu sắc</label>
                                <input type="text" class="form-control" name="color" id="color">
                                @error('color')
                                    <style>
                                        [name="color"]{
                                            border: 1px solid rgb(240, 105, 105);
                                            outline: 0;
                                            box-shadow: 0 0 0 0.1rem rgb(240, 105, 105);
                                        }
                                    </style>
                                    <small class="text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="desc">Mô tả sản phẩm</label>
                            <textarea name="desc" class="form-control desc" id="desc" cols="30" rows="5"></textarea>
                            @error('desc')
                                <style>
                                    [name="desc"]{
                                        border: 1px solid rgb(240, 105, 105);
                                        outline: 0;
                                        box-shadow: 0 0 0 0.1rem rgb(240, 105, 105);
                                    }
                                </style>
                                <small class="text-danger font-weight-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="content">Nội dung sản phẩm</label>
                    <textarea name="content" class="form-control" id="content" cols="30" rows="5"></textarea>
                    @error('content')
                        <small class="text-danger font-weight-bold">{{ $message }}</small>
                    @enderror
                </div>

                <div class="row">
                    <div class="form-group col-3">
                        <label for="">Danh mục</label>
                        <select name="category_product" class="form-control" id="">
                            <option value="">Chọn danh mục</option>
                            <option value="skirt">Váy đầm</option>
                            <option value="shirt">Áo Nữ</option>
                            <option value="trouser">Quần Nữ</option>
                            <option value="sales_good_product">Sản phẩm bán chạy</option>
                            <option value="hot_product">Sản phẩm nổi bậc</option>
                        </select>
                        @error('category_product')
                            <style>
                                [name="category_product"]{
                                    border: 1px solid rgb(240, 105, 105);
                                    outline: 0;
                                    box-shadow: 0 0 0 0.1rem rgb(240, 105, 105);
                                }
                            </style>
                            <small class="text-danger font-weight-bold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="qty">Số lượng</label>
                        <input type="number" class="form-control" min="1" value="100" max="100" name="qty" id="qty">
                    </div>
                    <div class="form-group col-2">
                        <label for="thumb">Ảnh đại diện sản phẩm</label>
                        <input type="file" name="thumb" id="thumb">
                        @error('thumb')
                            <small class="text-danger font-weight-bold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-2">
                        <label for="thumb-1">Ảnh màu sản phẩm 1</label>
                        <input type="file" name="thumb1" id="thumb-1">
                        @error('thumb1')
                            <small class="text-danger font-weight-bold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-2">
                        <label for="thumb-2">Ảnh màu sản phẩm 2</label>
                        <input type="file" name="thumb2" id="thumb-2">
                        @error('thumb2')
                            <small class="text-danger font-weight-bold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-2">
                        <label for="thumb-3">Ảnh màu sản phẩm 3</label>
                        <input type="file" name="thumb3" id="thumb-3">
                        @error('thumb3')
                            <small class="text-danger font-weight-bold">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- col-3 --}}
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="">Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="active" value="active" checked>
                            <label class="form-check-label" for="active">
                                Còn hàng
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="trash" value="trash">
                            <label class="form-check-label" for="trash">
                                Hết hàng
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <div class="form-check col-3">
                            <input class="form-check-input" type="radio" name="S" id="S" value="S">
                            <label class="form-check-label" for="S">
                                Size S
                            </label>
                        </div>
                        <div class="form-check col-3">
                            <input class="form-check-input" type="radio" name="M" id="M" value="M">
                            <label class="form-check-label" for="M">
                                Size M
                            </label>
                        </div>
                        <div class="form-check col-3">
                            <input class="form-check-input" type="radio" name="L" id="L" value="L">
                            <label class="form-check-label" for="L">
                                Size L
                            </label>
                        </div>
                        <div class="form-check col-3">
                            <input class="form-check-input" type="radio" name="XL" id="XL" value="XL">
                            <label class="form-check-label" for="XL">
                                Size XL
                            </label>
                        </div>
                        <div class="form-check col-3">
                            <input class="form-check-input" type="radio" name="XXL" id="XXL" value="XXL">
                            <label class="form-check-label" for="XXL">
                                Size XXL
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" name="btn-add" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection