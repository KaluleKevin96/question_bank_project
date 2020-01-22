<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('course_code', 20)->unique();
            $table->string('course_name', 100)->unique();
            $table->string('associated_college', 20); //references college number from the colleges table
            $table->integer('course_duration')->unsigned()->default(3);
            $table->string('course_description', 255)->default("<p> No Description Listed </p>");

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
        Schema::dropIfExists('courses');
    }
}
