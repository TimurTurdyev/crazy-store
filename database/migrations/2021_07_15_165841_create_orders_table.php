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
            $table->foreignId('user_id')->references('id')->on('users');

            $table->string('order_number')->unique();

            $table->enum('status', ['pending', 'processing', 'completed', 'decline'])->default('pending');
            $table->decimal('total', 10, 2);
            $table->unsignedInteger('item_count');

            $table->boolean('payment_status')->default(1);
            $table->string('payment_method')->nullable();
            $table->boolean('shipping_status')->default(1);
            $table->string('shipping_method')->nullable();

            $table->string('firstname', 64);
            $table->string('lastname', 64);
            $table->string('address', 255);
            $table->string('city', 128);
            $table->string('country', 128);
            $table->string('post_code', 32);
            $table->string('phone', 32);
            $table->string('notes')->nullable();

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