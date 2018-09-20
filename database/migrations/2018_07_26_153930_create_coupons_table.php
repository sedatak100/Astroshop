<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('coupon_id');
            $table->tinyInteger('status')->default(0);
            $table->string('name');
            $table->string('code')->unique();
            $table->string('type');
            $table->decimal('discount', 15, 4);
            $table->decimal('total', 15, 4);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('uses_total');
            $table->integer('uses_customer');
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
        Schema::dropIfExists('coupons');
    }
}
