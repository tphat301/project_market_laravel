@extends("layouts.client")
@section("title", $detailProduct->name)
@section("content")
<div class="container box-cart">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li style="display: flex;">
                        <i class="fa-solid fa-house" style="padding-right: 6px;"></i>
                        <a href="{{url('/')}}" title="Trang chủ">Trang chủ</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="detail-product row">
        <div class="detail-left col-6">
            <div  class="img-wrapper">
                <img src="{{asset( $detailProduct->thumb )}}" class="img-detail-product rounded" alt="">
                <div class="img-cover"></div>
            </div>
            <div class="info-detail-product">
                <h3>THÔNG TIN SẢN PHẨM</h3>
                <p class="desc-detail-product">
                    {{ $detailProduct->desc }}
                </p>
                <table class="table table-responsive table-bordered bg-white d-inline-block">
                    <thead>
                        <tr>
                            <th class="w-50">Thương hiệu</th>
                            <td style="width: 462px;">{{ $detailProduct->trandmake }}</td>
                        </tr>
                        <tr>
                            <th>Màu sắc</th>
                            <td>{{ $detailProduct->color }}</td>
                        </tr>
                        <tr>
                            <th>Chất liệu</th>
                            <td>{{ $detailProduct->fabric_material }}</td>
                        </tr>
                        <tr>
                            <th>Size</th>
                            <td>{{ $detailProduct->S }} {{ $detailProduct->M }} {{ $detailProduct->L }} {{ $detailProduct->XL }} {{ $detailProduct->XXL }}</td>
                        </tr>
                        <tr>
                            <th>Số đo ba vòng</th>
                            <td>87 – 68 – 93</td>
                        </tr>
                    </thead>
                </table>
                <div class="detail-content">
                    {!! $detailProduct->content !!}
                </div>
                @if (Auth::check())
                    <div class="title-votes">
                        <p>Bình chọn 5/5 sao sản phẩm {{$detailProduct->name}}</p>
                    </div> 
                    <div class="star">
                        @for ($count = 1; $count <= 5; $count++)
                            @php
                                if($count <= $rating) {
                                    $color = "color: #ea8948;";
                                } else {
                                    $color = "color: #dadada;";
                                }
                            @endphp
                            <div class="star-item" id="{{ $detailProduct->id }}-{{ $count }}" data-index="{{ $count }}" data-product_id="{{ $detailProduct->id }}"  style="margin-bottom: 12px; {{ $color }}">
                                <i class="fa-solid fa-star"></i>
                            </div>
                        @endfor
                    </div>
                @endif
                <form action="{{route('product.vote.update_content_comment', $detailProduct->id )}}" method="POST">
                    @csrf
                    @error('content-comment')
                        <style>
                            [name="content-comment"]{
                                border: 1px solid rgb(240, 105, 105);
                                outline: 0;
                                box-shadow: 0 0 0 0.1rem rgb(240, 105, 105);
                            }
                        </style>
                        <small class="text-danger font-weight-bold" style="display: block; margin-bottom: 6px;">{{ $message }}</small>
                    @enderror
                    <textarea name="content_comment" id="" cols="100" rows="3" class="rounded form-control" placeholder="Hãy đăng nhập và chia sẻ một số cảm nhận về sản phẩm của chúng tôi..."></textarea> 
                    <div class="form-control mb-3 p-0 d-flex" style="border-top: none; justify-content: space-between;">
                        <div class="upload-img" style="display: inline-block;">
                            <a href="{{ url('quy-dinh-dang-binh-luan-tai-market-shop') }}" style="display: block; text-decoration: none; padding: 6px 12px;">Quy định bình luận</a>
                        </div>
                        @if (Auth::check())
                            <input type="submit" name="btn-comment" class="btn btn-primary" value="Gửi" style="padding: 4px 25px !important;">
                        @else
                            <input type="submit" name="btn-comment" class="btn btn-primary" value="Gửi" style="padding: 4px 25px !important;" disabled>
                        @endif
                    </div>
                    <div class="contain"><img src="" id="img-show" alt="" style="max-width:150px; margin-bottom: 12px;"></div>
                    <div class="quantity-comment" style="margin-bottom: 12px;"><strong>Có {{ $comment->total() }} bình Luận</strong></div>
                    <div class="box-border" style="border: 1px solid #e0e0e0; border-radius: 8px; padding: 15px 15px 20px; background: #fff;">
                        <p class="rating-title" style="font-weight:bold; font-size: 26px; padding-bottom: 26px; border-bottom: 1px solid #dadada;">Đánh giá {{ $detailProduct->name }}
                        </p>
                            @if (count($comment_emp) == 0)
                                <div class="content-comment" style="margin-top: 12px;">
                                    <p style="color: #3a3a3acc;">Chưa có bình luận</p>
                                </div>
                            @endif

                            @if (count($comment_emp) > 1)
                                @foreach ($comment_emp as $item)
                                    <div class="content-comment" style="margin-top: 12px; margin-bottom: 24px;">
                                        <strong style="margin-bottom: 8px; display:block;">
                                            {{ $item->fullname }}
                                        </strong>
                                        <p style="color: #3a3a3acc;">{{ $item->content_comment }}</p>
                                    </div>
                                @endforeach
                            @endif

                            @if (count($comment_emp) == 1)
                                <div class="content-comment" style="margin-top: 12px; margin-bottom: 24px;">
                                    <strong style="margin-bottom: 8px; display:block;">
                                        {{ $comment_emp[0]->fullname }}
                                    </strong>
                                    <p style="color: #3a3a3acc;">{{ $comment_emp[0]->content_comment }}</p>
                                </div>
                            @endif
                    </div>
                </form>
            </div>
        </div>
        <!-- Detail Product Left -->
        <div class="detail-right col-6">
            <div class="name-detail-product">{{ $detailProduct->name }}</div>
            <p class="code"><strong>Mã sản phẩm</strong> {{ $detailProduct->code }}</p>
            <span class="price-detail-product">{{ number_format($detailProduct->price_new, 0, ',', '.') }}đ</span>
            <div class="choose-color">
                <h3 class="title-choose-color">Chọn màu</h3>
                <div class="box-image-color">
                    <img src="{{asset( $detailProduct->thumb1 )}}" class="color-1" alt="">
                    @if ($detailProduct->thumb2)
                        <img src="{{asset( $detailProduct->thumb2 )}}" class="color-2" alt="">
                    @endif
                    @if ($detailProduct->thumb3)
                        <img src="{{asset( $detailProduct->thumb3 )}}" class="color-3" alt="">
                    @endif
                </div>
            </div>
            <form action="{{route('cart.add', $detailProduct->id)}}" method="POST">
                @csrf
                <select name="choose-size" id="" class="choose-size">
                    <option value="">--Chọn Size--</option>
                    @if ($detailProduct->S)
                        <option value="S">S</option>
                    @endif
                    @if ($detailProduct->M)
                        <option value="M">M</option>
                    @endif
                    @if ($detailProduct->L)
                        <option value="L">L</option>
                    @endif
                    @if ($detailProduct->XL)
                        <option value="Xl">XL</option>
                    @endif
                    @if ($detailProduct->XXL)
                        <option value="XXl">XXL</option>
                    @endif
                </select>
                <div class="qt-detail">
                    <h3 class="qt-title">Số lượng</h3>
                    <div class="quanti">
                        <span title="Giảm" id="minus" class="sub-qty btn"><i class="fa fa-minus" aria-hidden="true"></i></span>
                        <input id="sl" name="quantity" value="1" class="txtNumPro" type="text">
                        <span title="Thêm" id="plus" class="add-qty btn"><i class="fa fa-plus" aria-hidden="true"></i></span>
                    </div>
                </div>
                @if($detailProduct->status == 'active')
                    <input type="submit" name="btn-buyNow" value="Thêm vào giỏ" class="btn-buy-now"> 
                @else
                    <span class="badge badge-danger">Hết hàng</span>
                @endif
            </form>
        </div>
        <!-- Detail Product Right -->
    </div>
</div>
<script async type="text/javascript">
const imgColor = [...document.querySelectorAll(".box-image-color img")];
const imgWrapper = document.querySelector(".img-wrapper");
const imgDetailProduct = document.querySelector(".img-detail-product");
const imgCover = document.querySelector(".img-cover");
const minus = document.getElementById("minus");
const plus = document.getElementById("plus");
const sl = document.getElementById("sl");
let number = parseInt(sl.getAttribute("value"));
imgCover.addEventListener("mousemove", function(e) {
    let pX = e.pageX;
    let pY = e.pageY;
    let imgWrapperWidth = imgWrapper.offsetWidth;
    let imgWrapperHeight = imgWrapper.offsetHeight;
    let imgDetailProductWidth = imgDetailProduct.offsetWidth;
    let imgDetailProductHeight = imgDetailProduct.offsetHeight;
    let spaceX = (imgDetailProductWidth / 5 - imgWrapperWidth) * 2;
    let spaceY = (imgDetailProductHeight / 4 - imgWrapperHeight) * 2; 
    imgDetailProductWidth = imgDetailProductWidth + spaceX;
    imgDetailProductHeight = imgDetailProductHeight + spaceY ; 
    let ratioX = imgDetailProductWidth / imgWrapperWidth / 2;
    let ratioY = imgDetailProductHeight / imgDetailProductHeight / 2;
    let x = (pX - imgWrapper.offsetLeft) * ratioX;
    let y = (pY - imgWrapper.offsetTop) * ratioY;
    imgDetailProduct.style = `left: ${-x}px; top: ${-y}px; width: auto; height: auto; max-height: unset;`;
});

imgCover.addEventListener("mouseleave", function(e) {
    imgDetailProduct.style = "";
});

plus.addEventListener("click", function(e) {
    let inputNumber = e.target.previousElementSibling;
    number++;
    if(number > 100) return;
    inputNumber.setAttribute("value", number);
});

minus.addEventListener("click", function(e) {
    let inputNumber = e.target.nextElementSibling;
    number--;
    if(number < 0) return;
    inputNumber.setAttribute("value", number);
});

imgColor.forEach(item => item.addEventListener("click", function(e) {
    imgColor.forEach(item => item.classList.remove("active-border"));
    this.classList.add("active-border");
    let getSrc = e.target.getAttribute("src");
    imgDetailProduct.setAttribute("src", getSrc);
})); 
</script>
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>

<script type="text/javascript">
let $jqr = jQuery.noConflict();
$jqr(document).ready(function () {
    function removeColor(product_id) {
        for(let count = 1; count <= 5; count++) {
            $jqr("#"+product_id+"-"+count).css("color","#dadada");
        }
    }
    $jqr(document).on("mouseenter", ".star-item", function() {
        let index = $jqr(this).data("index");
        let product_id = $jqr(this).data("product_id");
        for(let count = 1; count <= index; count++) {
            $jqr("#"+product_id+"-"+count).css("color", "#ea8948");
        }
    });
    $jqr(document).on("mouseleave", ".star-item", function() {
        let index = $jqr(this).data("index");
        let product_id = $jqr(this).data("product_id");
        removeColor(product_id);
    });

    $jqr(document).on("click", ".star-item", function() {
        let index = $jqr(this).data("index");
        let product_id = $jqr(this).data("product_id");
        data = {index:index, product_id:product_id, "_token": "{{ csrf_token() }}"}
        $jqr.ajax({
            url: "http://localhost/market/product/vote/stored",
            method: "POST",
            data: data,
            success: function (data) {
                if(data == "done") {
                    alert(`Cảm ơn quý khách đã đánh giá ${index} trên 5 sao sản phẩm của cửa hàng.`);
                } else {
                    alert("Đánh giá sản phẩm không thành công. Quý khách vui lòng thực hiện lại. Xin cảm ơn!");
                }
                return false;
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });

    const color1 = $jqr('.color-1');
    const color2 = $jqr('.color-2');
    const color3 = $jqr('.color-3');
    color1.click(function() {
        const imgColor1 = $jqr(this).attr('src');
        data = {imgColor1:imgColor1}
        $jqr.ajax({
            method: "GET",
            url: "http://localhost/market/cart/colorAjax",
            data: data,
            success: function (data) {
                console.log(data);
            }, 
            error: function() {
                console.log('Lỗi');
            }
        });
    });
    
    color2.click(function() {
        const imgColor2 = $jqr(this).attr('src');
        data = {imgColor2:imgColor2}
        $jqr.ajax({
            method: "GET",
            url: "http://localhost/market/cart/colorAjax",
            data: data,
            success: function (data) {
                console.log(data);
            }, 
            error: function() {
                console.log('Lỗi');
            }
        });
    });

    color3.click(function() {
        const imgColor3 = $jqr(this).attr('src');
        data = {imgColor3:imgColor3}
        $jqr.ajax({
            method: "GET",
            url: "http://localhost/market/cart/colorAjax",
            data: data,
            success: function (data) {
                console.log(data);
            }, 
            error: function() {
                console.log('Lỗi');
            }
        });
    });
});

</script>
@endsection