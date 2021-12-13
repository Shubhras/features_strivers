<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserSubscription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subscription', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('subscription_id')->unsigned()->nullable();
			$table->text('subscription_name');
			$table->timestamp('deleted_at')->nullable();
			$table->timestamp('created_at');
            $table->timestamp('updated_at');
			
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_subscription');
    }
}
