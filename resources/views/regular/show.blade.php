@extends("layouts.client")
@section("title", "Quy định đăng bình luận")
@section("content")
<style type="text/css">
    .box-cart h3 {
        margin-bottom: 12px;
    }
    .reg-title {
        font-size: 28px;
        text-align: center;
        display: block;
        margin-top: 24px;
        margin-bottom: 30px;
    }
    .contains-content {
        display: block;
        margin-bottom: 22px;
    }
    .reg-sub-title{font-size: 19px;}
</style>
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
    <h3>
        <strong class="reg-title">QUY ĐỊNH ĐĂNG BÌNH LUẬN TRÊN WEBSITE CỦA MARKET STORE</strong>
    </h3>
    <div class="contains-content">
        <h3>
            <strong class="reg-sub-title">1. Về nội dung bình luận</strong>
        </h3>
        <p>
            Các thành viên phải chịu trách nhiệm về sự phán đoán của mình khi sử dụng thông tin bình luận. Chúng tôi không chịu trách nhiệm về bất kỳ tổn hại phát sinh nào từ những thông tin bình luận đăng trên Market Store, hay những vấn đề phát sinh tranh chấp giữa các thành viên.
        </p>
    </div>
    <div class="contains-content">
        <h3>
            <strong class="reg-sub-title">2. Việc sử dụng thông tin đăng trên bảng bình luận</strong>
        </h3>
        <p>
            Chúng tôi không chấp nhận việc sao chép, sử dụng các thông tin ghi trên bảng bình luận của MARKET STORE khi không có sự đồng ý của công ty chúng tôi.<br><br>
    
            Sau khi người bình luận đăng tải thông tin lên MARKET STORE, công ty chúng tôi hoặc những tổ chức cá nhân được sự đồng ý của công ty chúng tôi có thể sử dụng nguồn thông tin này miễn phí. (Đăng lên tạp chí, copy, công bố rộng rãi, xuất bản, in ấn, dịch, soạn lại,...).
        </p>
    </div>
    <div class="contains-content">
        <h3>
            <strong class="reg-sub-title">3. Lưu ý</strong>
        </h3>
        <p>
            Hiện tại mục bình luận trên website MARKET STORE đang là sân chơi khá thú vị cho khách hàng được thỏa đam mê tìm hiểu sản phẩm và nêu lên cảm nghĩ cá nhân mình, tuy nhiên để tạo một hệ thống thông tin có trật tự, giúp ích tốt nhất đến cho người sử dụng, chúng tôi có thể xóa những thông tin có những nội dung liên quan như sau:
        </p><br>
        <p>
            -Thông tin bình luận không được kiểm chứng, không được xác thực.
        </p><br>
        <p>
            - Thông tin viết giống nhau lặp đi lặp lại.
        </p><br>
        <p>
            - Thông tin không liên quan gì đến nội dung của sản phẩm, dịch vụ cần bình luận.
        </p><br>
        <p>
            - Những dòng lệnh lập trình có hại.
        </p><br>
        <p>
            - Thông tin xâm hại đến quyền lợi hoặc đời tư của người khác.
        </p><br>
        <p>
            - Thông tin mang tính bài xích, gây tổn thương đến người khác.
        </p><br>
        <p>
            - Thông tin có liên quan đến các hành vi tội phạm.
        </p><br>
        <p>
            - Nhưng thông tin vi phạm đạo đức, thuần phong mỹ tục của Việt Nam và các nước khác.
        </p><br>
        <p>
            - Thông tin có liên quan đến những việc nguy hiểm.
        </p><br>
        <p>
            - Thông tin mang tính trục lợi, thương mại cá nhân, tuyên truyền quảng cáo.
        </p><br>
        <p>
            - Thông tin liên quan đến chính trị, tôn giáo
        </p><br>
        <p>
            - Đặt tên hoặc bình luận không rõ nội dung.
        </p><br>
        <p>
            - Thông tin ảnh hưởng đến công việc kinh doanh của MARKET STORE
        </p><br>
        <p>
            - Đặt tên hoặc bình luận không rõ nội dung.
        </p><br>
        <p style="font-style:italic">
            (Trường hợp khách hàng vẫn đăng những thông tin như trên <strong>MARKET STORE</strong> sẽ khóa quyền bình luận của khách lại để tập trung phục vụ những bình luận có nội dung phù hợp, mong quý khách thông cảm và lưu ý để tránh trường hợp phát sinh).
        </p><br>
        <p>
            <strong>Xin trân trọng cảm ơn!</strong>
        </p>
    </div>
</div>
@endsection