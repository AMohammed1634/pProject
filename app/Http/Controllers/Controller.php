<?php

namespace App\Http\Controllers;
use App\review;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\DB;
use App\User;
use App\category;
use App\department;
use App\product;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function home(){
        $cat = category::all();$items =[];
        /*foreach ($cat as $one){
            $asd = DB::table('product_category')->where('category_id','=', $one->category_id)->first();
            //$items [] = DB::table('products')->where('id' ,'=' ,$asd->product_id)->first();
        }*/
        //$test = product::all();
        //return $cat[0]->product;
        $latest = DB::table('products')->latest('id')->limit(8)->get();
        $mostPop = DB::table('products')->where('display','>','2')->get();

        return view('home',['cat' => $cat,'items' => $items,'latest'=>$latest,'mostPop'=>$mostPop]);
    }
    public function contact(){
        return view('contact');
    }
    public function register(){
        return view('register');

    }
    public function storeUser(Request $request){
        $this->validate($request , [
            'name' => 'required',
            'email'=> 'required|email',
            'pass1'=> 'required|min:6',
            'pass2'=> 'required|min :6'
        ]);
        if($request->pass1 !== $request->pass2){
            return redirect()->back()->withErrors('Passward are Nt The same');
        }
        $found = DB::table('users')->where('email','=',$request->email)->get();
        //return count($found);
        if(count($found)!=0){
            return redirect()->back()->withErrors('this email is used Try Again ....');
        }
        $user = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = $request->pass1;
        $user->is_admin = 0;
        $user->save();
        auth()->login($user);
        return redirect(route('home'));
    }
    public function showLogin(){
        return view('login');
    }
    public function login(Request $r){
        //dd(  $r->getClientIps());
        //return request("name");
        $this->validate($r,[
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        //$user = new User();
        $user = User::where('email','=',$r->email,'and')->get();
        if(count($user) === 0){
            return redirect(route('register'))->withErrors('Create An Acount First');
        }
        //return "ASD ".$user[0]->email;
        //return $user;
        if($user[0]->password != $r->password){
            return redirect()->back()->withErrors('Password Is Wrong');
        }
        //auth()->attempt(request(['email','password']));
        //$user = User::find($r->email);
        auth()->login($user[0]);
        //return auth()->user();

            return redirect(route('home'));
    }
    public function logout(){
        auth()->logout();
        return \redirect(route('home'));
    }
    public function viewProduct($id){

        return view('product');
    }

    public function viewCategory($id){
        $category = category::where('id','=',request('id'))->first();
        $departments = department::all();
        $categories = DB::table('categories')->where('department_id','=',1)->get();
        //return $categories;
        $mostPop = DB::table('products')->where('display','>','2')->get();
        //return count($mostPop);
        return view('category',['category'=>$category,'departments'=>$departments,'mostPop'=>$mostPop]);
    }
    public function applaySort($id){
        return "asd ".request('sort');
        $category = category::where('id','=',request('id'))->first();
        $departments = department::all();
        $categories = DB::table('categories')->where('department_id','=',1)->get();
        //return $categories;
        return view('category',['category'=>$category,'departments'=>$departments]);
    }

    public function allCategories(){
        //$categories = DB::table('categories')->latest()->paginate(1);
        $categories = category::latest()->paginate(1);
        $departments = department::all();
        $mostPop = DB::table('products')->where('display','>','2')->get();
        return view('allCategories',['categories'=>$categories,'departments'=>$departments,'mostPop'=>$mostPop]);
    }
    public function addReview($id){

        if(!\auth()->check()){
            return redirect(route('login'));
        }
        if(\request('rating')> 5 || \request('rating')<1){
            return redirect()->back()->withErrors( 'The Rating Must be In Range 1 -> 5');
        }
        $this->validate(\request(),[
            'message'=>'required'
        ]);
        $review = new review();
        $review->review = request('message');
        $review->user_id = \auth()->user()->id;
        $review->product_id = $id;
        $review->rating = \request('rating');
        $review->save();
        return redirect()->back();
    }
    public function viewProfile($id){
        $user = User::find($id);
        if($user->id != auth()->user()->id){
          return redirect(route("home"));
        }
        return view('profile',[
            'user' => $user
        ]);
    }
    public function addImageProfile($id,Request $request){
        $user = User::find($id);
        $this->validate($request,[
           'img' => 'required|image'
        ]);
        if(!$request->hasFile('img')){
            return redirect(route('home'));
        }
        $fileObject = $request->file('img');
        $name = $fileObject->getClientOriginalName();
        $extension = $fileObject->getClientOriginalExtension();
        $fileObject->storeAs('profile_images',$name);
        $user->img = $name;
        $user->save();
        return redirect()->back();
    }

    /**
     * create function to set the duration of hot deal
     */





}
