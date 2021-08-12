<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_gallery', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cover_id')->nullable()->unsigned();
            //$table->foreign('gallery_id')->references('id')->on('video_gallery_item')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('slug');
            $table->dateTime('date');
            $table->dateTime('deletedAt')->nullable();
            $table->bigInteger('author_id')->nullable()->unsigned();
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
        Schema::dropIfExists('video_gallery');
    }
}
