<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('brand_id');
            $table->string('product_title');
            $table->string('description');
            $table->string('long_description');
            $table->integer('price');
            $table->integer('discount')->nullable();
            $table->integer('after_discount')->nullable();
            $table->string('sku');
            $table->string('slug');
            $table->string('product_image')->nullable();
            $table->string('added_by');
            $table->integer('status')->default('0');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
