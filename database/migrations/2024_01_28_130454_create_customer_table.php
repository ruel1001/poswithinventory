<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id('account_number');
            $table->string('area');
            $table->string('account_name');
            $table->string('address');
            $table->string('date_plan');
            $table->string('amount_of_installation');
            $table->string('due_date_month');
            $table->string('foc');
            $table->string('modem');
            $table->string('connector');
            $table->string('account_balance');
            $table->string('arrears');
            $table->string('ficamp');
            $table->string('others');
            $table->string('messenger');
            $table->string('contact_number');
            $table->string('plan_subscribed');
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
        Schema::dropIfExists('customer');
    }
};
