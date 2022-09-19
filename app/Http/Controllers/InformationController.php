<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Visitor;
use App\Models\Visitor_date;
use Carbon\Carbon;

class InformationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function information(){
        if(Auth::user()->type =='Admin'){
        $weekCount = Visitor_date::whereDate('created_at', '>=',Carbon::now()->addWeeks(-1))->count();
        // $yesterdayCount=Visitor_date::whereDate('created_at', '>=',Carbon::now()->addDays(-1))->count();
        $yesterdayCount=Visitor_date::where('created_at', '>=', Carbon::now()->yesterday())->where('created_at', '<=', Carbon::now()->startOfDay())->count();
        $todayCount=Visitor_date::whereDate('created_at', '>=',Carbon::now()->addDays(0))->count();
        $totalCount=Visitor_date::whereDate('created_at', '<=',Carbon::now())->count();
        }
        else{
            $weekCount = Visitor_date::where('visitor_enter_by', '=',Auth::user()->id)->whereDate('created_at', '>=',Carbon::now()->addWeeks(-1))->count();
            // $yesterdayCount=Visitor_date::where('visitor_enter_by', '=',Auth::user()->id)->whereDate('created_at', '>=',Carbon::now()->addDays(-1))->count();
            $yesterdayCount=Visitor_date::where('visitor_enter_by', '=',Auth::user()->id)->where('created_at', '>=', Carbon::now()->yesterday())->where('created_at', '<=', Carbon::now()->startOfDay())->count();
            $todayCount=Visitor_date::where('visitor_enter_by', '=',Auth::user()->id)->whereDate('created_at', '>=',Carbon::now()->addDays(0))->count();
            $totalCount=Visitor_date::where('visitor_enter_by', '=',Auth::user()->id)->whereDate('created_at', '<=',Carbon::now())->count();

        }
        $data=compact('weekCount','yesterdayCount','todayCount','totalCount');
        return view('information')->with($data);
    }
}
