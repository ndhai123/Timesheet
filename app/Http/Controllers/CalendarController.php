<?php

namespace App\Http\Controllers;

use App\Models\CalendarModel;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(){
        $data = CalendarModel::all();
        return view('calendar') -> with(['data' => $data]);
    }
}
