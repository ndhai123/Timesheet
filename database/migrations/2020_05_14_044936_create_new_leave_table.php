<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewLeaveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_leave', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('user_mail')->nullable();
            $table->String('type_leave')->nullable();
            $table->float('duration')->nullable();
            $table->date('start_day')->nullable();
            $table->date('end_day')->nullable();
            $table->string('paitial_day')->nullable();
            $table->string('reason')->nullable();
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
        Schema::dropIfExists('new_leave');
    }
}
