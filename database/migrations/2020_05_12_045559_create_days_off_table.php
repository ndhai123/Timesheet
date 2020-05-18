<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaysOffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days_off', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_mail')->nullable();
            $table->integer('paid_leave')->nullable();
            $table->integer('unpaid_leave')->nullable();
            $table->integer('ariral_leave')->nullable();
            $table->integer('take_care_of_children')->nullable();
            $table->integer('maternity_leave')->nullable();
            $table->integer('funeral_leave_of_whole_sister_or_brother')->nullable();
            $table->integer('funeral_leave_parent_chiledren')->nullable();
            $table->integer('summer_vacation_leave')->nullable();
            $table->integer('special_leave')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('days_off');
    }
}
