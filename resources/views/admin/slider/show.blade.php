@extends("layouts.admin")
@section("title", "Danh sách sliders")
@section("content")
<div id="content" class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
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
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card-header font-weight-bold">
                    Thêm slider
                </div>
                {!! Form::open(['url'=> 'admin/slider/store', 'method'=>'POST', 'files'=>true]) !!}
                    @csrf
                    <div class="form-row">
                        <div class="form-group pt-2 pl-4 col-6">
                            <label for="slider" class="d-block">Ảnh</label>
                            <input type="file" name="thumbnail" id="slider">
                            
                        </div>
                        <div class="col-6 pt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="active" value="active" checked>
                                <label class="form-check-label" for="active">
                                    Công khai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="trash" value="trash">
                                <label class="form-check-label" for="trash">
                                    Chờ duyệt
                                </label>
                            </div>
                        </div>
                        <button type="submit" name="btn-add" class="btn btn-primary ml-4 mb-4">Thêm ảnh</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách slider
                </div>
                <div class="card-body">
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Người tạo</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thời gian tạo</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                                <tr>
                                    <td scope="row">1</td>
                                    <td><img class="img-thumbnail" src="{{ asset($slider->thumbnail) }}" alt="Ảnh" style="max-width:98px;"></td>
                                    <td><span class="text-info">{{ $slider->author }}</span></td>
                                    <td>
                                        @if ($slider->status == "active")
                                            <span class="p-1 bg-primary text-white border-1 rounded">
                                                @php
                                                    echo "Công khai";
                                                @endphp
                                            </span>
                                        @else
                                            <span class="p-1 bg-warning text-white border-1 rounded">
                                                @php
                                                    echo "Chờ duyệt";
                                                @endphp
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{$slider->created_at->format('m:h:s d/m/Y')}}</td>
                                    <td>
                                        <a href="{{ route('admin.slider.convert.status', $slider->id) }}" class="btn btn-success btn-sm rounded text-white" onclick="return confirm('Bạn có muốn chuyển trạng thái?');" type="button" data-toggle="tooltip" data-placement="top" title="Chuyển trạng thái"><i class="fas fa-sync-alt"></i></a>
                                        <a href="{{ route('admin.slider.delete', $slider->id) }}" class="btn btn-danger btn-sm rounded text-white" onclick="return confirm('Bạn có muốn xóa slider?');" type="button" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection