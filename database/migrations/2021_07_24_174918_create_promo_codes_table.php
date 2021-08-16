<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //coupon_id
        //name
        //code
        //type
        //discount
        //logged
        //shipping
        //total
        //date_start
        //date_end
        //uses_total
        //uses_customer
        //status
        //date_added
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->string('code', 32)->unique();
            $table->enum('type', ['P', 'F'])->default('P');
            $table->boolean('logged')->default(0);
            $table->mediumInteger('discount');
            $table->integer('total')->nullable();
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->integer('uses_total')->nullable();
            $table->integer('uses_customer')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('promo_codes');
    }
}
