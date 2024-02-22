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
        Schema::create('maintenance', function (Blueprint $table) {
            $table->id('maintenance_id');
            $table->string('account_name');
            $table->string('address');
            $table->string('account_number');
            $table->string('area');
            $table->string('material_used');
            $table->string('material_quantity_used');
            $table->string('nature_of_repair');
            $table->string('material_id');
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
        Schema::dropIfExists('maintenance');
    }
};