<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('order_product_id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->string('name');
            $table->string('model');
            $table->integer('quantity');
            $table->decimal('price', 15, 4);
            $table->decimal('tax', 15, 4);
            $table->decimal('total', 15, 4);
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
        Schema::dropIfExists('order_products');
    }
}
