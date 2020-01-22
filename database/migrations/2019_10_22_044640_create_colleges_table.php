<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colleges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('college_number', 20)->unique();
            $table->string('college_name', 150)->unique();
            $table->string('college_description', 255)->default("<p> No Description Listed </p>");

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
        Schema::dropIfExists('colleges_models');
    }
}
