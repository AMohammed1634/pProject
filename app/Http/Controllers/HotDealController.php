<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hotDeal;
use Illuminate\Support\Facades\DB;

class HotDealController extends Controller
{
    //
    public function __construct()
    {

    }
    public function getTimer(){
        $var =hotDeal::where('fire',1)->first();
        $d_counter = $var->day;
        $h_counter = $var->hour;
        $m_counter = $var->min;
        $s_counter = $var->sec;
        if($var->day == 0 && $var->hour==0 && $var->min == 0&& $var->sec ==0){
            $myArr = array("d_counter"=>"00",
                "h_counter"=>"00",
                "m_counter"=>"00",
                "s_counter"=>"00",
            );
            $myJSON = json_encode($myArr);
            return $myJSON;
        }
        if($s_counter==0){
            $s_counter = 59;
            if($m_counter==0){
                $m_counter=59;
                if($h_counter==0){
                    $h_counter = 23;
                    if($d_counter==0){
                        /**
                         * timer OUT
                         */
                    }else{
                        $d_counter--;
                    }
                }else{
                    $h_counter--;
                }
            }else {
                $m_counter--;
            }
        }else if($s_counter > 0){
            $s_counter--;
        }
        $var->day = $d_counter;
        $var->hour = $h_counter;
        $var->min = $m_counter;
        $var->sec = $s_counter;
        $myArr = array("d_counter"=>$d_counter,
            "h_counter"=>$h_counter,
            "m_counter"=>$m_counter,
            "s_counter"=>$s_counter,
        );
        $var->save();
        $myJSON = json_encode($myArr);

        return $myJSON;
    }

    public function storeTimer(Request $request){
        //dd(request()->all());
        if(!auth()->user()->is_admin){
            return redirect(route('login'))->withErrors("Login As Admin");
        }
        $time = new hotDeal();
        $time->day = $request->day;
        $time->hour = $request->hour;
        $time->min = $request->min;
        $time->sec = $request->sec;
        $time->user_id = auth()->user()->id;
        $time->save();

    }

    public function setHotDeal(){

        if(!auth()->user()->is_admin){
            return redirect(route('login'))->withErrors("Login As Admin");
        }
        $deals = DB::table('hot_deals')->where([
                                    ['fire','=',0],

                                ])->get();
        //dd($deals);
        return view('hotDeal',['deals'=>$deals]);
    }

    public function fireDeal(Request $request){
        if(!auth()->user()->is_admin){
            return redirect(route('login'))->withErrors("Login As Admin");
        }
        $expirDeal = hotDeal::where([
                                    ['fire','=',0],
                                    ['day','=',0],
                                    ['hour','=',0],
                                    ['min','=',0],
                                    ['sec','=',0]
                                    ])->get();
        //dd($expirDeal);
        //$expirDeal->fire = -1;
        $deal = hotDeal::find($request->deal);
        //dd($request->all());
        $deal->fire = 1;
        $deal->save();
        return redirect()->back();
    }
}
