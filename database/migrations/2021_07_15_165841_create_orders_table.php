<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->foreignId('user_id')->nullable()->references('id')->on('users');

            $table->uuid('order_code')->unique();

            $table->ipAddress('ip')->nullable();
            $table->string('firstname', 64);
            $table->string('lastname', 64);
            $table->string('email', 128);
            $table->string('phone', 32);

            $table->string('payment_code', 64)->nullable()->index();

            $table->string('city', 128)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('post_code', 32)->nullable();

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
