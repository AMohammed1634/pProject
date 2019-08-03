<?php
use Illuminate\Support\Facades\DB;
?>
@extends('masterView')
@section('header')
<section class="home_banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content row">
                <div class="col-lg-5">
                    <h3>Georgia Helmet <br />Collections!</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                    <a class="white_bg_btn" href="#">View Collection</a>
                </div>
                <div class="col-lg-7">
                    <div class="halemet_img">
                        <img src="img/banner/helmat.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('body')
    <!--================Feature Product Area =================-->
    <section class="feature_product_area">
        <div class="main_box">
            <div class="container">

                <div class="feature_product_inner">
                    <div class="main_title">
                        <h2>Featured Products</h2>
                        <p>Who are in extremely love with eco friendly system.</p>
                    </div>
                    <div class="feature_p_slider owl-carousel">
                        <!--  -->

                        @foreach($cat as $item)
                            <?php $i=0;?>
                            @foreach($item->product as $pro)
                                <div class="item">
                                    <div class="f_p_item">
                                        <div class="f_p_img">
                                            <img class="img-fluid" src="product_images\{{$pro->img}}" alt="">
                                            <div class="p_icon">
                                                <a href="{{route('addWishList',$pro->id)}}"><i class="lnr lnr-heart"></i></a>
                                                <a href="{{route('addToCart',$pro->id)}}"><i class="lnr lnr-cart"></i></a>
                                            </div>
                                        </div>
                                        <a href="/viewCategory/{{$item->id}}"><h4>{{$item->name}}</h4></a>
                                        <?php
                                        //$product_id = DB::table('product_category')->where('category_id','=', $item->category_id);
                                        ?>
                                        <h5>$ {{$pro->price}}</h5>
                                    </div>
                                </div>
                                <?php $i++;if($i>=1) break; ?>
                            @endforeach
                        @endforeach
                        <!--   -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Feature Product Area =================-->
    <!--================Deal Timer Area =================-->
    <section class="timer_area">
        <div class="container">
            <div class="main_title">
                <h2>Exclusive Hot Deal Ends Soon!</h2>
                <p>Who are in extremely love with eco friendly system.</p>
                <a class="main_btn" href="#">Shop Now</a>
            </div>
            <style>
                .font{
                    font-size: 30px;
                }
            </style>
            <div class="timer_inner">
                <div id="timer" class="timer">
                    <div class="timer__section days">
                        <div class="font" id="day"></div>
                        <div class="timer__label">days</div>
                    </div>
                    <div class="timer__section hours">
                        <div class="font" id="hour"></div>
                        <div class="timer__label">hours</div>
                    </div>
                    <div class="timer__section minutes">
                        <div class="font" id="min"></div>
                        <div class="timer__label">Minutes</div>
                    </div>
                    <div class="timer__section seconds">
                        <div class="font" id="sec"></div>
                        <div class="timer__label">seconds</div>
                    </div>
                </div>
            </div>

            <script>
                var duration = <?php echo 12;?>;
                console.log(duration);
                var d = document.getElementById('day'),d_counter = duration;
                var h = document.getElementById('hour'),h_counter = 0;
                var m = document.getElementById('min'),m_counter = 0;
                var s = document.getElementById('sec'),s_counter = 1;
                /*
                d.innerHTML = duration;
                h.innerHTML = "00";
                m.innerHTML = "00";
                s.innerHTML = "00";
                //setInterval(myTimer,1000);
                function myTimer() {
                    if(s_counter==0){
                        s_counter = 59;
                        if(m_counter==0){
                            m_counter=59;
                            if(h_counter==0){
                                h_counter=23;
                                if(d_counter==0){
                                    console.log("TIME OUT");
                                }else{
                                    d_counter--;
                                }
                            }else{
                                h_counter--;
                            }
                        }else {
                            m_counter--;
                        }
                    }else if(s_counter > 0){
                        s_counter--;
                    }
                    d.innerHTML = d_counter;
                    h.innerHTML = h_counter;
                    m.innerHTML = m_counter;
                    s.innerHTML = s_counter;


                }*/
                console.log("ASD");
                /**
                 * create this timer in server side useing AJAX & JSON
                 */
                window.setInterval(timerServer,1000);
                function timerServer(){
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            //document.getElementById("txtHint").innerHTML = this.responseText;
                            //alert(this.responseText);
                            console.log(this.responseText);

                            var result = JSON.parse( this.responseText);
                            console.log(result);
                            d.innerHTML = result.d_counter;
                            h.innerHTML = result.h_counter;
                            m.innerHTML = result.m_counter;
                            s.innerHTML = result.s_counter;
                        }
                    };
                    xmlhttp.open("GET", "http://127.0.0.1:8000/getTime", true);
                    xmlhttp.send();
                }
            </script>

        </div>
    </section>
    <!--================End Deal Timer Area =================-->
    <!--================Latest Product Area =================-->
    <section class="feature_product_area latest_product_area">
        <div class="main_box">
            <div class="container">
                <div class="feature_product_inner">
                    <div class="main_title">
                        <h2>Latest Products</h2>
                        <p>Who are in extremely love with eco friendly system.</p>
                    </div>
                    <div class="latest_product_inner row">

                        @foreach($latest as $element)
                            <!--    -->
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="f_p_item">
                                    <div class="f_p_img">
                                        <img class="img-fluid" src="product_images\{{$element->img}}" alt="">
                                        <div class="p_icon">
                                            <a href="{{route('addWishList',$element->id)}}"><i class="lnr lnr-heart"></i></a>
                                            <a href="@if(Auth::check())
                                                        {{route('addToCart',Auth::user()->id)}}
                                                    @else
                                                        {{route('login')}}
                                                    @endif"><i class="lnr lnr-cart"></i></a>
                                        </div>
                                    </div>
                                    <a href="viewProduct/{{$element->id}}"><h4>{{$element->name}}</h4></a>
                                    <h5>$
                                        @if($element->discounted_price == 0)
                                            {{$element->price}}
                                        @else
                                            {{$element->discounted_price}}
                                        @endif
                                    </h5>
                                </div>
                            </div>
                        @endforeach
                        <!--    -->
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!--================End Latest Product Area =================-->



@endsection
