<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('adm_num')->unique();
            $table->integer('user_id');
            $table->integer('course_id');
            $table->boolean('units_submitted')->default(0);
            $table->string('nationality');
            $table->string('primary_email');
            $table->string('secondary_email');
            $table->string('primary_phone');
            $table->string('secondary_phone');
            $table->string('postal_address');
            $table->boolean('government_sponsored');
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
        Schema::dropIfExists('students');
    }
}
