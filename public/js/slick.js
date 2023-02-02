var $jq = jQuery.noConflict();
        $jq(document).ready(function () {
            $jq('.banner-slider').slick({
                dots: false,
                infinite: false,
                autoplay: true,
                autoplaySpeed: 2000,
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                prevArrow:"<button type='button' class='banner-btn slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
                nextArrow:"<button type='button' class='banner-btn slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
                // cssEase: 'linear',
                responsive: [
                                {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: 3,
                                    slidesToScroll: 1,
                                    infinite: true,
                                    dots: false
                                }
                                },
                                {
                                breakpoint: 600,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1
                                }
                                },
                                {
                                breakpoint: 480,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1
                                }
                                }
                            ]
                });

                $jq('.list-address').slick({
                    infinite: true,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    prevArrow:"<button type='button' class='address-slider-btn address-slider-btn-prev slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
                    nextArrow:"<button type='button' class='address-slider-btn address-slider-btn-next slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
                    responsive: [
                        {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            infinite: true,
                            dots: false
                        }
                        },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                        },
                        {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                        }
                    ]
                });

                $jq('.list-arrivals').slick({
                    infinite: true,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    prevArrow:"<button type='button' class='arrivals-btn arrivals-btn-prev slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
                    nextArrow:"<button type='button' class='arrivals-btn arrivals-btn-next slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
                    responsive: [
                        {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            infinite: true,
                            dots: false
                        }
                        },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                        },
                        {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                        }
                    ]
                });

                $jq('.featured').slick({
                    infinite: true,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    prevArrow:"<button type='button' class='featured-btn featured-btn-prev slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
                    nextArrow:"<button type='button' class='featured-btn featured-btn-next slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
                    responsive: [
                        {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            infinite: true,
                            dots: false
                        }
                        },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                        },
                        {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                        }
                    ]
                });

                // Back Top 
                $jq(window).scroll(function () { 
                    if($jq(this).scrollTop() !== 0) {
                        $jq("#btn-top").stop().fadeIn(200);
                    } else {
                        $jq("#btn-top").stop().fadeOut(200);
                    }
                });
                $jq("#btn-top").click(function() {
                    $jq("html,body").stop().animate({scrollTop: 0}, 700);
                });

                $jq(window).scroll(function () { 
                    const header = $jq("#header");
                    const titleCounter = $jq(".counter-time-desc h3");
                    const titleFreeShip = $jq(".free-ship-desc h3");
                    const titleSafe = $jq(".safe-shop-desc h3");
                    if($jq(this).scrollTop() > 69) {
                        header.css({"background":"#ffffff", "box-shadow":"0 0 6px rgba(0, 0, 0, 0.3)", "padding":"2px 0"});
                        titleCounter.css("color", "#000");
                        titleFreeShip.css("color", "#000");
                        titleSafe.css("color", "#000");
                    } else {
                        header.css("background", "#000");
                        header.css("transition", "all .25s linear");
                        titleCounter.css("color", "#fff");
                        titleFreeShip.css("color", "#fff");
                        titleSafe.css("color", "#fff");
                    }
                });
        });
