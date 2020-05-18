<?php

namespace App\Http\Controllers;

use App\Models\CheckinCheckoutModel;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckinCheckoutController extends Controller
{
    public function getcheckinCheckout(){
        return view('checkinCheckout');
    }
    public function postcheckin(){
        date_default_timezone_set("Asia/tokyo");
        $checkin = CheckinCheckoutModel::where('date',date('Y-m-d'))->get();
            // cach 1 dung model
        if($checkin->count() > 0){
           return redirect('/')->withErrors('You have successfully checkin in. Please check again');
        }
        else{
            $checkin = new CheckinCheckoutModel();
            $checkin ->user_mail =Auth::user()->email;
            $checkin->date=date('Y-m-d');
            $checkin->checkin=date('H:i:s');
            $checkin->save();
            return view('login');
        }
    }
    public function postcheckout(){

        $checkout = CheckinCheckoutModel::where('date',date('Y-m-d'))->get();
        if($checkout->count() == 0){
                return redirect('/')->withErrors('Please check that you have not checked');
        }
        else{
            $tz_object = new DateTimeZone('Asia/Tokyo');
            $checkout=CheckinCheckoutModel::where('user_mail',Auth::user()->email)->where('date',date('Y-m-d'))->first();
            $endtime= new DateTime();
            $endtime->setTimezone($tz_object);
            if(date('H:i:s',strtotime($endtime->format('H:i:s'))-strtotime($checkout->checkin)) >=
            date('H:i:s',strtotime('09:00:00'))){
                $break_time='01:00:00';
            }else{
                $break_time='00:00:00';
            }

            $working_time = date('H:i:s',strtotime($endtime->format('H:i:s')) - strtotime($checkout->checkin)-
            strtotime($break_time));

            if(date('H:i:s',strtotime($working_time)) > date('H:i:s',strtotime('08:00:00'))){
                $over_time =date('H:i:s', strtotime($working_time)) - date('H:i:s',strtotime('08:00:00'));
            }else{
                $over_time = '00:00:00';
            }
            if(date('H:i:s',strtotime($working_time)) < date('H:i:s',strtotime('08:00:00'))){
                $missing_time =date('H:i:s',strtotime('08:00:00') - strtotime($working_time));
            }else{
                $missing_time = '00:00:00';
            }
            if($checkout->checkout==null){
                $checkout->checkout=$endtime;
                $checkout->break_time=$break_time;
                $checkout->working_time=$working_time;
                $checkout->over_time=$over_time;
                $checkout->missing_time=$missing_time;
                $checkout->save();
                return view('login');
            }else{
                return redirect('/')->withErrors('You have checkout, please check again');
            }

        }
        // $checkout=checkincheckout::where('staff',Auth::user()->email)->where('word_day',date('Y-m-d'))->first();
        // $checkout->work_time=$checkout->end_time-$checkout->start_time-$checkout->break_time;
        // $checkout->save();
    }
}
