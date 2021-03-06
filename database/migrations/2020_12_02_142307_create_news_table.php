<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('gallery_id')->nullable()->unsigned();
            //$table->foreign('gallery_id')->references('id')->on('gallery')->onDelete('cascade');
            $table->bigInteger('author_id')->nullable()->unsigned();
            //$table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title', 200);
            $table->string('subtitle')->nullable();
            $table->longText('content');
            $table->string('slug');
            $table->dateTime('publication');
            $table->string('file');
            $table->timestamps();
            $table->bigInteger('copyright_id')->unsigned();
            //$table->foreign('copyright_id')->references('id')->on('copyright')->onDelete('cascade');
            $table->bigInteger('views')->default(0);
            $table->tinyInteger('highlight')->default(0);
            $table->dateTime('deletedAt')->nullable();
            $table->bigInteger('tag_id')->nullable()->unsigned();
            //$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->bigInteger('cover_id')->nullable()->unsigned();
            $table->tinyInteger('visible')->nullable();
            $table->bigInteger('video_gallery_id')->nullable()->unsigned();
            //$table->foreign('video_gallery_id')->references('id')->on('video_gallery')->onDelete('cascade');
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
        Schema::dropIfExists('news');
    }
}
