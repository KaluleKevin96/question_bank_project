<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_units', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('course_unit_code', 20)->unique();
            $table->string('course_unit_name', 100)->unique();
            $table->string('associated_course', 20); //references college number from the courses table
            $table->integer('credit_units')->unsigned();
            $table->integer('course_unit_semester')->unsigned();
            $table->string('course_unit_description', 255)->default("<p> No Description Listed </p>");

            $table->string('status' , 20)->default('active');
            $table->Integer('autonumber')->unsigned();
            $table->smallInteger('year')->unsigned();
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
        Schema::dropIfExists('course_units');
    }
}
