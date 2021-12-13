<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CoachCourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	{
		Schema::create('coach_course', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('coach_id')->unsigned()->nullable();
			$table->text('course_name');
			$table->text('course_hourse');
			$table->text('description');
			
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('coach_course');
	}
}
