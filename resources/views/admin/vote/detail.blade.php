@extends("layouts.admin")
@section("title", $product->name)
@section("content")
<div class="card" style="margin-bottom: 14px; margin-top: 20px;margin-left: 14px;">
    <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
        <h5 class="m-0 ">Thông tin chi tiết sản phẩm đánh giá</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped table-checkall table-bordered">
            <thead>
                <tr>
                    <th scope="col">Tên người đánh giá</th>
                    <th scope="col">Tên sản phẩm đánh giá</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Ngày đánh giá</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $comment->fullname }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $comment->content_comment }}</td>
                    <td>{{ $comment->created_at->format("d/m/Y m:h:s") }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection