<?php

namespace App\Http\Controllers;

use App\Models\CheckinCheckoutModel;
use App\Models\MonthlyTimesheetModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class TimesheetController extends Controller
{
    public function index(){
        $mail = Auth::user()->email;
        //dd($mail);
        $monthlyTimesheet = MonthlyTimesheetModel::where('user_mail', $mail)->get();
        //dd($monthlyTimesheet);
        //return view('monthlyTimesheet') ->with($mail);
        return view('monthlyTimesheet') ->with(['data' => $monthlyTimesheet]);
    }

    public function monthlyList($year, $month){
        $mail = Auth::user()->email;
        $from = date($year.'-'.$month.'-01');
        $to = date($year.'-'.$month.'-31');
        $monthlyDetailt = CheckinCheckoutModel::where('user_mail', $mail)->whereBetween('date', [$from, $to])->get();
        //dd($monthlyDetailt);
        return view('monthlyDetail') ->with(['data' => $monthlyDetailt]);
    }

    public function dateDetailEdit($date){
        $mail = Auth::user()->email;
        $dateDetail = CheckinCheckoutModel::where('user_mail', $mail)->where('date', $date)->first();
        return view('dateDetailEdit')->with(['data' => $dateDetail]);
    }

    public function dateDetailEditSave(Request $request){
        $mail = Auth::user()->email;
        $date = $request->date;
        $dateDetail = CheckinCheckoutModel::where('user_mail', $mail)->where('date', $date)->first();
        $dateDetail->checkin_modify = $request->checkin_modify;
        $dateDetail->checkout_modify = $request->checkout_modify;
        $dateDetail->break_time_modify = $request->breaktime_modify;
        $dateDetail->status = 1;
        $dateDetail->save();
        //dd($dateDetail);
        return redirect(route('dateDetailEdit',[$date])) ->with('success', 'Update Done');

    }
}
