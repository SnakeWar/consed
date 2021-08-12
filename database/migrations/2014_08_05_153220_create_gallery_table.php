<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cover_id')->nullable()->unsigned();
            //$table->foreign('cover_id')->references('id')->on('gallery_image')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('slug');
            $table->dateTime('date')->nullable();
            $table->dateTime('deletedAt')->nullable();
            $table->bigInteger('author_id')->nullable()->unsigned();
            //$table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('visible')->default(0);
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
        Schema::dropIfExists('gallery');
    }
}
