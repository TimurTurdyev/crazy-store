<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variant_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variant_id')->references('id')->on('variants')->cascadeOnDelete();
            $table->string('path');
            $table->smallInteger('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variant_photos');
    }
}
