<?php

namespace App\Http\Controllers;

use App\DaysOffModel;
use App\Models\NewLeaveModel;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DayOffController extends Controller
{
    public function getDayOff(){
        $dayOff = DaysOffModel::where('user_mail',Auth::user()->email)->get();
            return view('admin/dayOff')->with('dayOff',$dayOff);
    }
    public function getEdit($id){
        $edit = DaysOffModel::find($id)->get();
        return view('admin/edit')->with('edit',$edit);
    }
    public function postEdit($id,Request $request){
       $request->offsetUnset('_token');
        $edit = DaysOffModel::where('id',$id)->update($request->all());
        return redirect('admin/dayOff');
    }
    public function getDelete($id){
        DaysOffModel::find($id)->delete();
         return redirect('/');
    }
    public function getNewLeave(){
        $dayOff = DaysOffModel::where('user_mail',Auth::user()->email)->get();
        return view('newLeave')->with('dayoff',$dayOff);
    }
    public function postCountLeave(Request $request){

        $showLeave = DaysOffModel::where('user_mail',Auth::user()->email)->first();

        if($request->type_leave == 1){
            $count = $showLeave->paid_leave;
        }
        if($request->type_leave == 2){
            $count = $showLeave->unpaid_leave;
        }
        if($request->type_leave == 3){
            $count = $showLeave->ariral_leave;
        }
        if($request->type_leave == 4){
            $count = $showLeave->take_care_of_children;
        }
        if($request->type_leave == 5){
            $count = $showLeave->maternity_leave;
        }
        if($request->type_leave == 6){
            $count = $showLeave->funeral_leave_of_whole_sister_or_brother;
        }

        if($request->type_leave == 7){
            $count = $showLeave->funeral_leave_parent_chiledren;
        }
        if($request->type_leave == 8){
            $count = $showLeave->summer_vacation_leave;
        }
        if($request->type_leave == 9){
            $count = $showLeave->special_leave;
        }
        return response()->json([
            'error' => false,
            'data'  => $count
        ], 200);
    }
    public function postCountDay(Request $request){

        // $start_day = $request->star_day;
        // $end_day =$request->end_day;
        //  $start_day_ms = $start_day.gettimeofday();
        //  $end_day_ms = $end_day.gettimeofday();
        //  $difference_ms = Match.abs($end_day_ms - $start_day_ms);
        // return response()->json([
        //     'error' => false,
        //     'data'  => $start_day
        // ], 200);
    }

    public function postLeave(Request $request){
        $saveLeave = new NewLeaveModel();
        $saveLeave->user_mail = Auth::user()->email;
        if($request->type_leave == 1){
            $request->type_leave = $saveLeave->type_leave;
            $saveLeave->type_leave = 'Paid Leave';
        }
        if($request->type_leave == 2){
            $request->type_leave= $saveLeave->type_leave;
            $saveLeave->type_leave = 'Unpaid Leave' ;
        }
        if($request->type_leave == 3){
            $request->type_leave = $saveLeave->type_leave;
            $saveLeave->type_leave = 'Ariral Leave';
        }
        if($request->type_leave == 4){
            $request->type_leave = $saveLeave->type_leave;
            $saveLeave->type_leave = 'Take Care Of Children';
        }
        if($request->type_leave == 5){
            $request->type_leave = $saveLeave->type_leave;
            $saveLeave->type_leave = 'Maternity Leave';
        }
        if($request->type_leave == 6){
            $$request->type_leave = $saveLeave->type_leave;
            $saveLeave->type_leave = 'Funeral Leave(Of Whole Sister Or Brother)';
        }
        if($request->type_leave == 7){
            $$request->type_leave = $saveLeave->$saveLeave->type_leave;
            $saveLeave->type_leave = 'Funeral Leave( Parent Chiledren)';
        }
        if($request->type_leave == 8){
            $$request->type_leave = $saveLeave->type_leave;
            $saveLeave->type_leave= 'Summer Vacation Leave';
        }
        if($request->type_leave == 9){
            $$request->type_leave = $saveLeave->type_leave;
            $saveLeave->type_leave = 'Special Leave';
        }
        if($request->type_day == 1 ){
           $request->type_day = $saveLeave->paitial_day;
            $saveLeave->paitial_day = 'All Day';
            $start_day = $request->start_day;
            $end_day = $request->end_day;
            $datetime1 = new DateTime($start_day);
            $datetime2 = new DateTime($end_day);
            $interval = $datetime1->diff($datetime2);
            $days = 0;
            for($i=0; $i<=$interval->d; $i++){
                $datetime1->modify('+1 day');
                $weekday = $datetime1->format('w');

                if($weekday !== "0" && $weekday !== "6"){ // 0 for Sunday and 6 for Saturday
                    $days++;
                }

            }

        }
        if($request->type_day == 2 ){
           $request->type_day = $saveLeave->paitial_day;
            $saveLeave->paitial_day = 'Morning';
            $start_day = $request->start_day;
            $end_day = $request->end_day;
            $datetime1 = new DateTime($start_day);
            $datetime2 = new DateTime($end_day);
            $interval = $datetime1->diff($datetime2);
            $days = ($interval->format('%a'))/2;
            for($i=0; $i<=$interval->d; $i++){
                $datetime1->modify('+1 day');
                $weekday = $datetime1->format('w');

                if($weekday !== "0" && $weekday !== "6"){ // 0 for Sunday and 6 for Saturday
                    ($days++)/2;
                }

            }
        }
        if($request->type_day == 3 ){
           $request->type_day = $saveLeave->paitial_day;
            $saveLeave->paitial_day = 'Afternoon';
            $start_day = $request->start_day;
            $end_day = $request->end_day;
            $datetime1 = new DateTime($start_day);
            $datetime2 = new DateTime($end_day);
            $interval = $datetime1->diff($datetime2);
            $days = 0;
            for($i=0; $i<=$interval->d; $i++){
                $datetime1->modify('+1 day');
                $weekday = $datetime1->format('w');

                if($weekday !== "0" && $weekday !== "6"){ // 0 for Sunday and 6 for Saturday
                    ($days++)/2;
                }

            }
        }
        $saveLeave->start_day = $start_day;
        $saveLeave->end_day = $end_day;
        $saveLeave->duration = $days;
        $saveLeave->reason = $request->reason;
        $saveLeave->save();
        return redirect()->back();
    }
}
