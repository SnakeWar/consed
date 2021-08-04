<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('poll_id')->unsigned()->nullable();
            $table->foreign('poll_id')->references('id')->on('polls')->onDelete('cascade');

            $table->bigInteger('alternative_id')->unsigned()->nullable();
            $table->foreign('alternative_id')->references('id')->on('alternatives')->onDelete('cascade');

            $table->string('ip', 30);
            
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
        Schema::dropIfExists('votes');
    }
}
