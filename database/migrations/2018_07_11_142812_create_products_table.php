<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('product_id');
            $table->tinyInteger('status')->default(0);
            $table->string('name');
            $table->string('seo_name');
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('image')->nullable();
            $table->integer('brand_id')->default(0);
            $table->string('model')->nullable();
            $table->string('stock_code')->nullable();
            $table->string('barcode')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('serial_no2')->nullable();
            $table->string('serial_no3')->nullable();
            $table->decimal('price', 15, 8)->default(0);
            $table->integer('currency_id');
            $table->integer('quantity')->default(0);
            $table->integer('min_quantity')->default(0);
            $table->tinyInteger('subtract')->default(0);
            $table->integer('stock_status_id')->default(0);
            $table->tinyInteger('shipping')->default(0);
            $table->integer('tax_class_id')->default(0);
            $table->date('date_available')->nullable();
            $table->decimal('length', 15, 8)->default(0);
            $table->decimal('width', 15, 8)->default(0);
            $table->decimal('height', 15, 8)->default(0);
            $table->integer('length_id')->default(0);
            $table->decimal('weight', 15, 8)->default(0);
            $table->integer('weight_id')->default(0);
            $table->integer('order')->default(0);
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
