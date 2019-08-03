<?php

namespace App\Http\Controllers;

use App\order;
use App\shopping_cart;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use App\User;
use App\category;
use App\department;
use App\product;

class elementController extends Controller
{
    public function __construct()
    {

    }

    //
    public function showElements(){
        $categories = category::latest()->paginate(1);
        return view('elements',[
            'categories' => $categories
        ]);
    }
    public function editElement($id){
        if(auth()->check()) {
            if (!auth()->user()->is_admin) {
                return redirect()->back()->withErrors('Login AS Admin In System');
            }
        }else {
            return redirect()->back()->withErrors('Login AS Admin In System First');
        }
        $product = product::find($id);
        return view('edit',[
            'product' => $product
        ]);
    }
    public function updateElement($id,Request $request){
        if(auth()->check()) {
            if (!auth()->user()->is_admin) {
                return redirect()->back()->withErrors('Login AS Admin In System');
            }
        }else {
            return redirect()->back()->withErrors('Login AS Admin In System First');
        }
        $product = product::find($id);
        $product->name              = $request->name;
        $product->description       = $request->description;
        $product->price             = $request->price;
        $product->discounted_price  = $request->discounted_price;
        $product->save();
        return redirect(route('elements'))->withErrors('Updated Succeefully ');
    }
    public function addToCart(product $product){
        if(!auth()->check()){
            return redirect(route('login'))->withErrors('LoginFirst Or Create An Acount');
        }
        $shopping_cart              = new shopping_cart();
        $shopping_cart->cart_id     = time();
        $shopping_cart->product_id  = $product->id;
        $shopping_cart->user_id     = auth()->user()->id;
        $shopping_cart->order_id    = -1;
        $shopping_cart->save();
        //return $product;
        return redirect()->back();
    }
    public function shopping_cart(){
        if(!auth()->check()){
            return redirect(route('login'));
        }
        $carts = shopping_cart::where('user_id','=',auth()->user()->id)->where('ordered','=',1)->get();
        //return $carts;
        return view('shopping_cart',[
           'carts'  => $carts
        ]);
    }
    public function makeOrder(){
        if(!auth()->check()){
            return redirect(route('login'));
        }
        $order = new order();
        $carts = shopping_cart::where('user_id','=',auth()->user()->id)->where('ordered','=',1)->get();

        $total = 0;
        foreach($carts as $cart){
            $total+=($cart->quantity * $cart->product->price);
        }
        $order->total_amount = $total;
        $order->customer_id = auth()->user()->id;
        $order->shipping_id = time();
        $order->save();
        foreach($carts as $cart){
            $cart->order_id = $order->id;
            $cart->ordered = 0;
            $cart->save();
        }
        /**
         * should send the $order->shipping_id = time(); to the email of user
         * to tracking
         */
        return redirect(route('home'));
    }
    public function checkout(){
        if(!auth()->check()){
            return redirect(route('login'));
        }
        $carts = shopping_cart::where('user_id','=',auth()->user()->id)->where('ordered','=',1)->get();

        $total = 0;
        foreach($carts as $cart){
            $total+=($cart->quantity * $cart->product->price);
        }



        return view('checkout',[
            'carts'  => $carts,
            'total'  => $total
        ]);
    }
    public function tracking(){
        if(!auth()->check() ||(auth()->check() && auth()->user()->is_admin == 0) ){
            return redirect(route('home'));
        }

        return view('tracking');
    }

    public function track(Request $request){
        if(!auth()->check() ||(auth()->check() && auth()->user()->is_admin == 0) ){
            return redirect(route('home'));
        }
        $order = order::where('shipping_id','=',$request->order)->first();
        //return $order->shopping;
        return view('tracking',compact('order'))->withErrors('check');
    }
    public function updateQuantityCartincrement(shopping_cart $cart){
        $cart->quantity ++;
        $cart->save();
        return json_encode(array('qua'=>$cart->quantity));
    }
    /**
     *
     * updateQuantityCartDecrement
     */
    public function updateQuantityCartDecrement(shopping_cart $cart){
        $cart->quantity --;
        $cart->save();
        return json_encode(array('qua'=>$cart->quantity));
    }
}
