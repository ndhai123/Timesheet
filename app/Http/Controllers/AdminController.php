<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CheckinCheckoutModel;

class AdminController extends Controller
{
    public function index(){
        return view('admin/login');
    }

    public function checkLogin(Request $request){
        $check = $request -> only('email', 'password');
        if(Auth::attempt($check) && Auth::user()->role == 1){
            return view('admin/home');
        }else{
            return redirect('admin/index') ->withErrors('Please check email or password');;
        }
    }


    public function modifyRequest(){
        $listRequest = CheckinCheckoutModel::where('status', 1)->get();
        return view('admin/dateDetail')->with(['data' => $listRequest]);
    }

    public function detailApprove($date, $userMail){
        $dateDetail = CheckinCheckoutModel::where('user_mail', $userMail)->where('date', $date)->first();
        return view('admin/dateDetailEdit')->with(['data' => $dateDetail]);
    }

    public function approve($date, $userMail){
        $dateDetail = CheckinCheckoutModel::where('user_mail', $userMail)->where('date', $date)->first();
        if($dateDetail->checkout_modify !=null){
           if( $dateDetail->checkin_modify !=null){
               $workingTime = strtotime($dateDetail->checkout_modify) -  strtotime($dateDetail->checkin_modify);
           }else{
                $workingTime = strtotime($dateDetail->checkout_modify) -  strtotime($dateDetail->checkin);
           }
        }else{
            if($dateDetail->checkin_modify !=null){
                $workingTime = strtotime($dateDetail->checkout) -  strtotime($dateDetail->checkin_modify);
            }else{
                $workingTime = strtotime($dateDetail->working_time);
            }
        }

        $start = strtotime('23:00:00');
        $end = strtotime('12:00:00');

        dd(date('h:i:s',$start-strtotime($dateDetail->working_time)));

        if($dateDetail->break_time_modify !=null){
            $workingTime = $workingTime - strtotime($dateDetail->break_time_modify);
        }else{
            $workingTime = $workingTime - strtotime($dateDetail->break_time);
        }

        if(date('h:i:s',$workingTime) > date('h:i:s',strtotime('08:00:00'))){
            $overTime = $workingTime - strtotime('08:00:00');
        }else{
            $overTime = 0;
        }

        if(date('h:i:s',$workingTime) < date('h:i:s',strtotime('08:00:00'))){
            $missingTime = strtotime('08:00:00') - $workingTime;
        }else{
            $missingTime = 0;
        }

        $dateDetail->status = '0';
        $dateDetail->working_time = date('h:i:s', $workingTime);

        if($missingTime > 0){
            $dateDetail->missing_time = date('h:i:s', $missingTime);
        }else{
            $dateDetail->missing_time = NULL;
        }

        if($overTime > 0){
            $dateDetail->over_time = date('h:i:s', $overTime);
        }else{
            $dateDetail->over_time = NULL;
        }

        $dateDetail->update();
        return back() ->with('success', 'Approved');
    }

    public function reject($date, $userMail){
        $dateDetail = CheckinCheckoutModel::where('user_mail', $userMail)->where('date', $date)->first();
        $dateDetail->status = '3';
        $dateDetail->update();
        return back() ->with('success', 'Rejected');
    }
}
