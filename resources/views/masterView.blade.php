<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" href="/img/tshirtshop.png" type="image/png">
        <title>TShirtShop</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/css/bootstrap.css">
        <link rel="stylesheet" href="/vendors/linericon/style.css">
        <link rel="stylesheet" href="/css/font-awesome.min.css">
        <link rel="stylesheet" href="/vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="/vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" href="/vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="/vendors/animate-css/animate.css">
        <link rel="stylesheet" href="/vendors/jquery-ui/jquery-ui.css">
        <!-- main css -->
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/responsive.css">
        @yield('includeStyle')
    </head>
    <body>
        <!--================Header Menu Area =================-->
        <header class="header_area">
            <div class="top_menu row m0">
                <div class="container">
                 <div class="float-left">
                     <a href="mailto:support@colorlib.com">support@colorlib.com</a>
                     <a href="#">Welcome to Catalouge</a>
                 </div>
                 <div class="float-right">
                     <ul class="header_social">
                         <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                         <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                         <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                         <li><a href="#"><i class="fa fa-behance"></i></a></li>
                     </ul>
                 </div>
                </div>
            </div>
         <div class="main_menu">
             <nav class="navbar navbar-expand-lg navbar-light main_box">
                 <div class="container">
                     <!-- Brand and toggle get grouped for better mobile display -->
                     <a class="navbar-brand logo_h" href="{{route('home')}}"><img src="/img/tshirtshop.png" alt=""></a>
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                     </button>
                     <!-- Collect the nav links, forms, and other content for toggling -->
                     <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                         <ul class="nav navbar-nav menu_nav ml-auto">
                             <li class="nav-item active"><a class="nav-link" href="{{route('home')}}">Home</a></li>
                             <li class="nav-item submenu dropdown">
                                 <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Shop</a>
                                 <ul class="dropdown-menu">
                                     <li class="nav-item"><a class="nav-link" href="{{route('allCategories')}}">Shop Category</a>
                                     <!--<li class="nav-item"><a class="nav-link" href="single-product.html">Product Details</a>
                                     <li class="nav-item"><a class="nav-link" href="checkout.html">Product Checkout</a>-->
                                     <li class="nav-item"><a class="nav-link" href="{{route('shopping_cart')}}">Shopping Cart</a></li>
                                     {{--}}<li class="nav-item"><a class="nav-link" href="confirmation.html">Confirmation</a></li>
                                        --}}
                                 </ul>
                             </li>
                             <li class="nav-item submenu dropdown">
                                 <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
                                 <ul class="dropdown-menu">
                                     <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                                     <li class="nav-item"><a class="nav-link" href="single-blog.html">Blog Details</a></li>
                                 </ul>
                             </li>
                             <li class="nav-item submenu dropdown">
                                 <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages</a>
                                 <ul class="dropdown-menu">
                                     <li class="nav-item"><a class="nav-link" href="{{route('register')}}">register</a>
                                     <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a>

                                     @if(Auth::check())
                                         @if(Auth::user()->is_admin === 1)
                                             <li class="nav-item">
                                                 <a class="nav-link" href="{{route('tracking')}}">Tracking</a>
                                             </li>
                                             <li class="nav-item">
                                                 <a class="nav-link" href="/product">Admin Elements</a>
                                             </li>
                                             <li class="nav-item" id="deal_asd">
                                                 <a class="nav-link" style="cursor: pointer"
                                                    href="{{route("setHotDeal")}}">
                                                    Set ٍHot Deal</a>
                                             </li>

                                         @endif
                                     @endif
                                 </ul>
                             </li>
                             <li class="nav-item"><a class="nav-link" href="{{route('contact')}}">Contact</a></li>
                         </ul>
                         <ul class="nav navbar-nav navbar-right">
                             <li class="nav-item">
                                 <style>
                                     .cart{
                                         position: absolute;
                                     }
                                     .asd{
                                         position: relative;
                                         top:-75px;
                                         left: 0;
                                         background-color:#FF0000;
                                         width:27px;
                                         border-radius: 50%;
                                         height: 29px;
                                         line-height: 2;
                                         padding: auto;
                                     }
                                 </style>
                                 <a href="{{route('shopping_cart')}}" class="cart">
                                     <i class="lnr lnr lnr-cart" ></i>
                                     @if(Auth::check())

                                        <div class="asd">{{count(Auth::user()->carts->where('ordered','=',1))}}</div>
                                     @endif
                                 </a>
                             </li>
                             <?php
                             use Illuminate\Support\Facades\Auth;
                             ?>
                             @if(Auth::check())
                             <li class="nav-item">
                                <a href="{{route('logout')}}" >LogOUt</a>
                                 <a href="{{route('viewProfile',Auth::user()->id)}}" title="{{Auth::user()->name}}"
                                    class="search">

                                     <img src="/storage/profile_images/{{Auth::user()->img}}" alt=""
                                          style="width: 50px;height: 50px; border-radius: 50%;">
                                 </a>

                             </li>
                             @else
                                 <li class="nav-item">
                                     <a href="{{route('login')}}" class="search">Login</a>
                                 </li>
                             @endif
                         </ul>
                     </div>
                 </div>
             </nav>
         </div>
     </header>
     <!--================Header Menu Area =================-->

        <!--================Home Banner Area =================-->


        @yield('header')

        <!--================End Home Banner Area =================-->

        @yield('body')
        <!--================ start footer Area  =================-->
        <footer class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3  col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h6 class="footer_title">About Us</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h6 class="footer_title">Newsletter</h6>
                            <p>Stay updated with our latest trends</p>
                            <div id="mc_embed_signup">
                                <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe_form relative">
                                    <div class="input-group d-flex flex-row">
                                        <input name="EMAIL" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address '" required="" type="email">
                                        <button class="btn sub-btn"><span class="lnr lnr-arrow-right"></span></button>
                                    </div>
                                    <div class="mt-10 info"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-footer-widget instafeed">
                            <h6 class="footer_title">Instagram Feed</h6>
                            <ul class="list instafeed d-flex flex-wrap">
                                <li><img src="/img/instagram/Image-01.jpg" alt=""></li>
                                <li><img src="/img/instagram/Image-02.jpg" alt=""></li>
                                <li><img src="/img/instagram/Image-03.jpg" alt=""></li>
                                <li><img src="/img/instagram/Image-04.jpg" alt=""></li>
                                <li><img src="/img/instagram/Image-05.jpg" alt=""></li>
                                <li><img src="/img/instagram/Image-06.jpg" alt=""></li>
                                <li><img src="/img/instagram/Image-07.jpg" alt=""></li>
                                <li><img src="/img/instagram/Image-08.jpg" alt=""></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="single-footer-widget f_social_wd">
                            <h6 class="footer_title">Follow Us</h6>
                            <p>Let us be social</p>
                            <div class="f_social">
                            	<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-dribbble"></i></a>
								<a href="#"><i class="fa fa-behance"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row footer-bottom d-flex justify-content-between align-items-center">
                    <p class="col-lg-12 footer-text text-center"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
            </div>
        </footer>
		<!--================ End footer Area  =================-->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="/js/jquery-3.2.1.min.js"></script>
        <script src="/js/popper.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/stellar.js"></script>
        <script src="/vendors/lightbox/simpleLightbox.min.js"></script>
        <script src="/vendors/nice-select/js/jquery.nice-select.min.js"></script>
        <script src="/vendors/isotope/imagesloaded.pkgd.min.js"></script>
        <script src="/vendors/isotope/isotope-min.js"></script>
        <script src="/vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="/js/jquery.ajaxchimp.min.js"></script>
        <script src="/vendors/counter-up/jquery.waypoints.min.js"></script>
        <script src="/vendors/flipclock/timer.js"></script>
        <script src="/vendors/counter-up/jquery.counterup.js"></script>
        <script src="/js/mail-script.js"></script>
        <script src="/js/theme.js"></script>
    </body>
</html>
