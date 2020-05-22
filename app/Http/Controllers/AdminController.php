<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CheckinCheckoutModel;
use App\Models\MonthlyTimesheetModel;
use App\Models\Users;
use App\User;
use PhpOffice\PhpSpreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


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
            return redirect('admin/index') ->withErrors('Please check email or password');
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

        if($missingTime != 0){
            $dateDetail->missing_time = date('h:i:s', $missingTime);
        }else{
            $dateDetail->missing_time = NULL;
        }

        if($overTime != 0){
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

    public function payslipMonth(){
        $listUser = MonthlyTimesheetModel::distinct()->get(['user_mail']);
        return view('admin/chooseMonthAndUser')->with('data', $listUser);
    }

    public function getListMonthPayslip(Request $request){
        $input = $request->user;
        $listMonth = MonthlyTimesheetModel::where('user_mail', $input)->get();
        return response()->json([
            'error' => false,
            'data'  => $listMonth,
        ], 200);
    }


    public function standardWorkingHourByMonth($year, $month, $ignore){
        $count = 0;
        $counter = mktime(0, 0, 0, $month, 1, $year);
        while (date("n", $counter) == $month) {
            if (in_array(date("w", $counter), $ignore) == false) {
                $count++;
            }
            $counter = strtotime("+1 day", $counter);
        }
        return $count * 8;
    }


    // public function caclPayslip($year, $month, $user){
    //     $monthlyDetail = MonthlyTimesheetModel::where('user_mail', $user)->where('year', $year)->where('month', $month)->get();

    //     $payslipModel = new PayslipModel();
    //     $payslipModel->user_mail = $user;
    //     $payslipModel->year = $year;
    //     $payslipModel->month = $month;

    // }



    public function createTimesheet(Request $request){
        $spreadsheet = IOFactory::load('assets/Timesheet.xlsx');

        $userMail = $request->user;
        $year = explode("/",$request->month)[0];
        $month = explode("/",$request->month)[1];
        $from = date($year.'-'.$month.'-01');
        $to = date($year.'-'.$month.'-31');
        $userDetail = Users::where("email", $userMail)->first();
        $detail = CheckinCheckoutModel::where('user_mail', $userMail)->whereBetween('date', [$from, $to])->orderBy( 'date' )->get();        // month

        $fileName = "勤務表&交通費申請書_".$userDetail->name."_".$year.$month.".xls";

        // month
        $spreadsheet->getActiveSheet()->setCellValue('A5', (int) $month);
        // name
        $spreadsheet->getActiveSheet()->setCellValue('G4', $userDetail->name);
        // number
        $spreadsheet->getActiveSheet()->setCellValue('G3', $userDetail->number);
        // amount working date
        $spreadsheet->getActiveSheet()->setCellValue('H8', count($detail));

        $date = 0;
        for($row = 8; $row < 39; $row++){
            if($date < count($detail) && $detail[$date]){
                $dateOfRow =  $spreadsheet->getActiveSheet()->getCell('A'.$row)->getFormattedValue();
                if((int)explode("-",$detail[$date]->date)[2]== $dateOfRow){
                    // approve
                    if($detail[$date]->status == 0){
                        if($detail[$date]->checkin_modify){
                            $spreadsheet->getActiveSheet()->setCellValue('C'.$row, date('H:i',strtotime($detail[$date]->checkin_modify)));

                        }else{
                            $spreadsheet->getActiveSheet()->setCellValue('C'.$row, date('H:i',strtotime($detail[$date]->checkin)));
                        }

                        if($detail[$date]->checkout_modify){
                            $spreadsheet->getActiveSheet()->setCellValue('D'.$row, date('H:i',strtotime($detail[$date]->checkout_modify)));
                        }else{
                            $spreadsheet->getActiveSheet()->setCellValue('D'.$row, date('H:i',strtotime($detail[$date]->checkout)));
                        }

                        if($detail[$date]->break_time_modify){
                            $spreadsheet->getActiveSheet()->setCellValue('E'.$row, date('h:i',strtotime($detail[$date]->break_time_modify)));

                        }else{
                            $spreadsheet->getActiveSheet()->setCellValue('E'.$row, date('H:i',strtotime($detail[$date]->break_time)));
                        }
                    }else{
                        $spreadsheet->getActiveSheet()->setCellValue('C'.$row, date('H:i',strtotime($detail[$date]->checkin)));
                        $spreadsheet->getActiveSheet()->setCellValue('D'.$row, date('H:i',strtotime($detail[$date]->checkout)));
                        $spreadsheet->getActiveSheet()->setCellValue('E'.$row, date('H:i',strtotime($detail[$date]->break_time)));
                    }
                    $spreadsheet->getActiveSheet()->setCellValue('F'.$row,'=TIMEVALUE("'.date('H:i',strtotime($detail[$date]->working_time)).'")');
                    $date = $date + 1;
                }
            }
        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($fileName);
        return $fileName;
    }

    public function outputExel(Request $request){
        $fileName = $this->createTimesheet($request);
       return response()->download(public_path($fileName));
    }

    public function getListUser(){
        $userList = Users::get();

        // dd($userList);
        return view('admin/listUser')->with('data', $userList);;
    }

    public function deleteUser($email){
        $user =User::where('email', $email)->where('role', 1)->delete();

        return back() ->with('success', 'Deleted');
    }

    public function addUser(Request $request){
        $checkEmail = User::where("email", $request->email)->get();
        $checkNumber = User::where("number", $request->number)->get();
        if($checkEmail || $checkNumber){
            return back() ->with('error', 'user email is exist');
        }

        $user = new Users();
        $user->name = $request->user_name;
        $user->email = $request->email;
        $user->password = bcrypt('123456');
        $user->role = $request->role;
        $user->number = $request->number;
        $user->save();
        return back() ->with('success', 'Created succed');
    }

}
