<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_papers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('paper_number', 100)->unique(); //secondary generated paper number (unique key)
            $table->string('course_unit_code', 100); //references course unit code for the attached course unit
            $table->string('associated_course', 20); //references course number from the courses table
            $table->integer('semester')->unsigned(); //semester in which the paper is to be sat
            $table->string('paper_category' , 10); //whether the paper is a test or exam paper
            $table->string('paper_title', 100); //user entered 'alias name' for the file
            $table->string('file_path',255); //the path to the file stored in the uploads folder
            $table->string('paper_description', 255)->default("<p> No Description Listed </p>"); //optional description

            $table->string('status' , 20)->default('active');
            $table->Integer('autonumber')->unsigned();
            $table->string('uploaded_by');
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
        Schema::dropIfExists('question_papers');
    }
}
