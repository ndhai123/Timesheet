<?php

namespace App\Http\Controllers;

use App\Models\CheckinCheckoutModel;
use App\Models\MonthlyTimesheetModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class MonthlyTimesheetController extends Controller
{
    public function index(){
        $mail = Auth::user()->email;
        //dd($mail);
        $monthlyTimesheet = MonthlyTimesheetModel::where('user_mail', $mail)->get();
        //dd($monthlyTimesheet);
        //return view('monthlyTimesheet') ->with($mail);
        return view('monthlyTimesheet') ->with(['data' => $monthlyTimesheet]);
    }

    public function monthly($year, $month){
        $mail = Auth::user()->email;
        //dd($mail);
        // $monthlyDetailt = MonthlyTimesheetModel::where('user_mail', $mail)->get();
        //dd($monthlyTimesheet);
        //return view('monthlyTimesheet') ->with($mail);

        $from = date($year.'-'.$month.'-01');
        $to = date($year.'-'.$month.'-31');
        $monthlyDetailt = CheckinCheckoutModel::where('user_mail', $mail)->whereBetween('date', [$from, $to])->get();
        //dd($monthlyDetailt);
        return view('monthlyDetail') ->with(['data' => $monthlyDetailt]);
    }
}
