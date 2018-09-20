<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('ticket_id');
            $table->integer('customer_id')->default(0);
            $table->integer('order_id')->default(0);
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('gsm');
            $table->string('subject');
            $table->string('message');
            $table->tinyInteger('reply')->default(0);
            $table->tinyInteger('close')->default(0);
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
        Schema::dropIfExists('tickets');
    }
}
