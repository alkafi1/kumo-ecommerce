<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing__details', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('customer_id');
            $table->string('name');
            $table->string('email');
            $table->string('company')->nullable();
            $table->string('mobile');
            $table->string('address');
            $table->integer('division_id');
            $table->integer('district_id');
            $table->integer('upazila_id');
            $table->integer('zip_code');
            $table->string('note')->nullable();
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
        Schema::dropIfExists('billing__details');
    }
}
