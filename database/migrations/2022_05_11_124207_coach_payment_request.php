<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CoachPaymentRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	{
		Schema::create('coach_payment_request', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('coach_id', 100)->nullable();
            $table->string('email', 100)->nullable();
			$table->string('payment', 100)->nullable();
            $table->string('payment_verified_at')->nullable()->default('Pending');
			
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('coach_payment_request');
	}
}
