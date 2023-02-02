@extends("layouts.client")
@section("title", "Liên hệ")
@section("content")
<style type="text/css">
    .section-head h3 {display: block; font-size: 24px !important; color: #000;font-weight: bold;padding-bottom: 12px;}
    .create-date {padding-bottom: 12px; display: block;}
    .detail h2 {padding-bottom: 6px; padding-top: 12px; display: block; font-size: 18px; font-weight: bold;}
    .main-content {padding: 18px !important; box-shadow: 0 0 6px rgba(0, 0, 0, 0.3); background: #fff;}
</style>
<div class="container box-cart">
    <div id="main-content-wp" class="clearfix detail-blog-page">
        <div class="wp-inner">
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
            <div class="main-content fl-right">
                <div class="section" id="detail-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title">{{$page->title}}</h3>
                    </div>
                    <div class="section-detail">
                        <span class="create-date">{{$page->created_at->format('d/m/Y m:h:s')}}</span>
                        <div class="detail">
                            <p>{!!$page->content!!}</p>
                        </div>
                    </div>
                </div>
                <div class="section" id="social-wp">
                    <div class="section-detail">
                        <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                        <div class="g-plusone-wp">
                            <div class="g-plusone" data-size="medium"></div>
                        </div>
                        <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection