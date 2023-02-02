<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('public/img/favicon-hoyang.png') }}" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield("title")</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="{{url('public/css/reset.css')}}">
    <link rel="stylesheet" href="{{url('public/css/checkout.css')}}">
    <link rel="stylesheet" href="{{url('public/css/app.css')}}">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <div class="row header-title container">
                <div class="col-4 counter-time">
                    <img src="{{asset('public/img/clock.png')}}" class="clock" alt="Clock">
                    <div class="counter-time-desc">
                        <h3 class="title-sale">Giảm giá sốc</h3>
                        <p>với nhiều ưu đãi lớn</p>
                    </div>
                </div>
                <div class="col-4 free-ship">
                    <img src="{{asset('public/img/car.png')}}" class="car" alt="car">
                    <div class="free-ship-desc">
                        <h3>Miễn phí giao hàng</h3>
                        <p>cho tất cả mặt hàng trên 100.000đ</p>
                    </div>
                </div>
                <div class="col-4 safe-shop">
                    <img src="{{asset('public/img/safe.png')}}" class="safe" alt="safe">
                    <div class="safe-shop-desc">
                        <h3>Mua sắm thỏa thích</h3>
                        <p>chỉ có tại Market Shop</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- HEADER -->
        @yield("content")
        {{-- CONTENT --}}

        <div id="footer">
            <div class="footer-body">
                <div class="follow container-body">
                    <h3>Kết nối với chúng tôi</h3>
                    <ul class="list-social">
                        <li><a href="" class="social-item fb facebook" data-social="facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href="" class="social-item tw twitter" data-social="twitter"><i class="fa-brands fa-twitter"></i></a></li>
                        <li><a href="" class="social-item gg google" data-social="google"><i class="fa-solid fa-g"></i></a></li>
                        <li><a href="" class="social-item git github" data-social="github"><i class="fa-brands fa-github"></i></a></li>
                        <li><a href="" class="social-item ig instagram" data-social="instagram"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="" class="social-item yt youtube" data-social="youtube"><i class="fa-brands fa-youtube"></i></a></li>
                    </ul>
                </div>
                <div class="sub-info-shop container-body">
                    <div class="our-shop">
                        <h3>Thông tin cửa hàng</h3>
                        <ul class="list-our-shops">
                            <li><a href="">Hỗ trợ sản phẩm</a></li>
                            <li><a href="">Hỗ trợ các dịch vụ liên quan</a></li>
                            <li><a href="">Dịch vụ</a></li>
                            <li><a href="">Dịch vụ mở rộng</a></li>
                            <li><a href="">Cộng đồng</a></li>
                        </ul>
                    </div>

                    <div class="orders">
                        <h3>Đơn hàng</h3>
                        <ul class="list-orders">
                            <li><a href="">Tài khoản</a></li>
                            <li><a href="">Theo dõi đơn hàng</a></li>
                            <li><a href="">Danh sách xem</a></li>
                            <li><a href="">Dịch vụ khách hàng</a></li>
                            <li><a href="">Đổi trả hàng</a></li>
                        </ul>
                    </div>

                    <div class="our-shop">
                        <h3>Thông tin cửa hàng</h3>
                        <ul class="list-our-shops">
                            <li><a href="">Hỗ trợ sản phẩm</a></li>
                            <li><a href="">Hỗ trợ các dịch vụ liên quan</a></li>
                            <li><a href="">Dịch vụ</a></li>
                            <li><a href="">Dịch vụ mở rộng</a></li>
                            <li><a href="">Cộng đồng</a></li>
                        </ul>
                    </div>

                    <div class="contact">
                        <h3>Liên lạc với chúng tôi</i></h3>  
                        <ul class="list-contact">
                            <li><a href=""><i class="fa-solid fa-location-dot"></i> Địa chỉ : Thành Phố Hồ Chí Minh</a></li>
                            <li><a href=""><i class="fa-solid fa-envelope"></i> Email : dolamthanhphat@gmail.com</a></li>
                            <li><a href=""><i class="fa-solid fa-phone"></i> Liên hệ: 0339355715</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom container-body">
                <div class="footer-bottom-left">
                    <p>© 2022 Market Shop bản quyền thuộc về @dolamthanhphat<a href=""> Marketshop.com</a></p>
                </div>
                <div class="footer-bottom-right">
                    <ul class="list-card">
                        <li><i class="fa-solid fa-credit-card"></i></li>
                        <li><i class="fa-brands fa-cc-visa"></i></li>
                        <li><i class="fa-brands fa-cc-paypal"></i></li>
                        <li><i class="fa-brands fa-cc-jcb"></i></li>
                    </ul>
                </div>
            </div>
            <!-- FOOTER BOTTOM -->
        </div>
        <!-- FOOTER -->

        <div id="btn-top">
            <div class="hotline-phone-ring-wrap">
                <div class="hotline-phone-ring">
                <div class="hotline-phone-ring-circle"></div>
                <div class="hotline-phone-ring-circle-fill"></div>
                <div class="hotline-phone-ring-img-circle">
                    <img src="{{asset('public/img/icon-to-top-new.png')}}" alt="back top" style="max-width: 100%; height: auto; display: block;"/>
                </div>
                </div>
            </div>
        </div>
        <!-- Back Top -->
    </div>


    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript"src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{url('public/js/main.js')}}"></script>
    <script src="{{url('public/js/slick.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
