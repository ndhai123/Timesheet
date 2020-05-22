<?php

namespace App\Http\Controllers;

use App\Models\CalendarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CalendarController extends Controller
{
    public function index(){
        $data = CalendarModel::all();
        return view('calendar') -> with(['data' => $data]);
    }
    public function getEvent(){
        $data = CalendarModel::all();
        return view('showEvent')->with('data',$data);
    }
    public function getAddEvent(){     
        return view('addEvent');
    }
    public function postAddEvent(Request $request){     
        $save = new CalendarModel();
        $save->date = $request->date;
        $save->event = $request->event;
        $save->save();
       return redirect('showEvent');
    }
    public function getEdit($id){ 
        $edit = CalendarModel::find($id); 
        return view('editEvent')->with('edit',$edit);
    }
    public function postEdit($id,Request $request){ 
        $request->offsetUnset('_token');
         CalendarModel::where('id',$id)->update($request->all()); 
        return redirect('showEvent');
    }
    public function getDeleteCalendar($id){
        CalendarModel::find($id)->delete();
         return redirect()->back();
    }
}
