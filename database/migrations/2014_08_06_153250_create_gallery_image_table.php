<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_image', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('gallery_id')->nullable()->unsigned();
            //$table->foreign('gallery_id')->references('id')->on('gallery')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('image');
            $table->string('source')->nullable();
            $table->dateTime('deletedAt')->nullable();
            $table->integer('ordem')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gallery_image');
    }
}
