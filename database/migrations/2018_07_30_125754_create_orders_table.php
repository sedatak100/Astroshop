<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id');
            $table->integer('customer_id')->default(0);
            $table->integer('customer_group_id')->default(0);
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('gsm')->nullable();
            $table->string('fax')->nullable();
            $table->string('shipping_method');
            $table->string('shipping_key');
            $table->integer('shipping_address_id')->default(0);
            $table->integer('shipping_country_id');
            $table->string('shipping_country');
            $table->integer('shipping_city_id');
            $table->string('shipping_city');
            $table->integer('shipping_district_id');
            $table->string('shipping_district');
            $table->string('shipping_firstname');
            $table->string('shipping_lastname');
            $table->string('shipping_company')->nullable();
            $table->text('shipping_address1');
            $table->text('shipping_address2')->nullable();
            $table->string('shipping_postcode')->nullable();
            $table->string('payment_method');
            $table->string('payment_key');
            $table->integer('payment_address_id')->default(0);
            $table->integer('payment_country_id');
            $table->string('payment_country');
            $table->integer('payment_city_id');
            $table->string('payment_city');
            $table->integer('payment_district_id');
            $table->string('payment_district');
            $table->string('payment_firstname');
            $table->string('payment_lastname');
            $table->string('payment_company')->nullable();
            $table->text('payment_address1');
            $table->text('payment_address2')->nullable();
            $table->string('payment_postcode')->nullable();
            $table->text('note')->nullable();
            $table->decimal('total', 15, 4);
            $table->integer('order_status_id')->default(0);
            $table->integer('currency_id');
            $table->string('currency_code');
            $table->string('currency_value');
            $table->ipAddress('ip');
            $table->text('user_agent');
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
        Schema::dropIfExists('orders');
    }
}
