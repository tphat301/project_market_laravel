@extends("layouts.client")
@section("title", "Danh sách váy đầm")
@section("content")
<div class="container box-cart">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li style="display: flex;">
                        <i class="fa-solid fa-house" style="padding-right: 6px;"></i>
                        <a href="{{url('/')}}" title="">Trang chủ</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <h3 class="title-skirt">Váy đầm</h3>
    <div class="skirt-main">
        <div class="filter">
            <p>Hiển thị tất cả {{ $skirtProduct->total() }} kết quả</p>
            <div class="form-filter">
                <select onchange="filter(this)" name="filter" id="filter" class="form-select form-control mr-1" required>
                    <option value="">Bộ lọc</option>
                    <option value="asc" >Giá từ thấp đến cao</option>
                    <option value="desc">Giá từ cao đến thấp</option>
                </select>
            </div>
        </div>
        <ul class="list-skirt">
            @foreach ($skirtProduct as $item)
                <li>
                    <a href="{{ route('product.detail', $item->slug) }}" class="thumb">
                        <img src="{{ asset($item->thumb) }}" alt="{{ $item->name }}" class="img-item">
                    </a>
                    <a href="{{ route('product.detail', $item->slug) }}" class="product-name">{{ $item->name }}</a>
                    <div class="star">
                        @for ($count = 1; $count <= 5; $count++)
                            @php
                                if($count <= $item->star_votes) {
                                    $color = "color: #ea8948";
                                } else {
                                    $color = "color: #dadada";
                                }
                            @endphp
                                <div class="star-item"><i class="fa-solid fa-star" style="{{$color}}"></i></div>
                        @endfor
                    </div>
                    <div class="price">
                        <span class="new">{{ number_format($item->price_new, 0, ',', '.') }}đ</span>
                        @if ($item->price_old > 0)
                            <span class="old">{{ number_format($item->price_old, 0, ',', '.') }}đ</span>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
        {{ $skirtProduct->links() }}
    </div>
    <script async type="text/javascript">
        const selectElement = document.getElementById("filter");
        function filter() {
            if(selectElement.value == "asc") {
                return window.location = "{{ url('danh-sach-vay-dam?filter=asc') }}";
            }
            if(selectElement.value == "desc") {
                return window.location = "{{ url('danh-sach-vay-dam?filter=desc') }}";
            }
        }
    </script>
</div>
@endsection