<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variant_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variant_id')->references('id')->on('variants')->cascadeOnDelete();
            $table->foreignId('size_id')->nullable()->references('id')->on('sizes')->onDelete('SET NULL');
            $table->mediumInteger('price');
            $table->mediumInteger('cost');
            $table->smallInteger('quantity');
            $table->tinyInteger('discount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variant_prices');
    }
}
