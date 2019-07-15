@extends('masterView')

@section('header')
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content text-center">
                    <h2>Shopping Cart</h2>
                    <div class="page_link">
                        <a href="{{route('home')}}">Home</a>
                        <a href="{{route('shopping_cart')}}">Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->
@endsection

@section('body')
    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!--  -->
                        <?php $total = 0;?>
                        @foreach($carts as $cart)
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="product_images\{{$cart->product->img}}" alt="" style="width: 147px;
                                                                                    height: 144px">
                                        </div>
                                        <div class="media-body">
                                            <p>{{$cart->product->name}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>${{$cart->product->price}}</h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <input type="text" name="qty" id="sst" maxlength="12" value="{{$cart->quantity}}" title="Quantity:" class="input-text qty">
                                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ))
                                        {result.value++;<?php $cart->quantity++; ?>}return false;" class="increase items-count" type="button">
                                            <i class="lnr lnr-chevron-up"></i>
                                        </button>
                                        <button onclick="var result = document.getElementById('sst'); var sst = result.value;
                                                if( !isNaN( sst ) &amp;&amp; sst > 0 )
                                                {result.value--; <?php $cart->quantity--; ?>}return false;" class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                    </div>
                                </td>
                                <td>
                                    <?php $total+=$cart->product->price * $cart->quantity; ?>
                                    <h5>${{$cart->product->price * $cart->quantity}}</h5>
                                </td>
                            </tr>
                        @endforeach
                        <!--  -->

                        <tr>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <h5>Subtotal</h5>
                            </td>
                            <td>
                                <h5>${{$total}}.00</h5>
                            </td>
                        </tr>

                        <tr class="out_button_area">
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <div class="checkout_btn_inner">
                                    <a class="gray_btn" href="{{route('allCategories')}}">Continue Shopping</a>
                                    <a class="main_btn" href="{{route('checkout')}}">Proceed to checkout</a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->

@endsection
