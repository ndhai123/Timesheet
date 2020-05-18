<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DayOffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('days_off')->delete();
        DB::table('days_off')->insert([
        'user_mail'=>'hai@123',
        'paid_leave'=>'1',
        'unpaid_leave'=>'0',
        'ariral_leave'=>'1',
        'take_care_of_children'=>'0',
        'maternity_leave'=>'9',
        'funeral_leave_of_whole_sister_or_brother'=>'0',
        'funeral_leave_parent_chiledren'=>'0',
        'summer_vacation_leave'=>'0',
        'special_leave'=>'0',
         ]);
    }
}
