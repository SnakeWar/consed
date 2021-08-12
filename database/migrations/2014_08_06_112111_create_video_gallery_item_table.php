<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoGalleryItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_gallery_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('gallery_id')->nullable()->unsigned();
//            $table->foreign('gallery_id')->references('id')->on('video_gallery')->onDelete('cascade');
            $table->string('url');
            $table->string('title')->nullable();
            $table->string('source');
            $table->dateTime('deletedAt');
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
        Schema::dropIfExists('video_gallery_item');
    }
}
