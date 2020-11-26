<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('image');
            $table->string('code');
            $table->text('details');
            $table->integer('quantity');
            $table->double('buy',2);
            $table->double('sell',2);
            $table->string('slug');
            $table->integer('visibility')->default(1);
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('inventory_categories');
             $table->unsignedBigInteger('subCategory_id');
            $table->foreign('subCategory_id')->references('id')->on('inventory_sub_categories');
             $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('inventory_brands'); 
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('update_user_id')->nullable();
            $table->foreign('update_user_id')->references('id')->on('users');   
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
        Schema::dropIfExists('inventory_products');
    }
}
