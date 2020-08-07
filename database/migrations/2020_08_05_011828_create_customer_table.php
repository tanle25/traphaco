<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('DMS_code')->nullable();
            $table->string('CRM_code')->nullable();
            $table->string('fullname')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('zone')->nullable();
            $table->string('sale_chanel')->nullable();
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
        Schema::dropIfExists('customers');
    }
}