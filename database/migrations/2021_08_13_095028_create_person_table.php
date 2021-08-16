<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('mail_address_id')->unsigned();
            $table->string('cpf')->nullable();
            $table->string('name');
            $table->string('name_slug');
            $table->date('birth');
            $table->string('land_line')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('corporate_mobile')->nullable();
            $table->string('email');
            $table->string('alternative_email')->nullable();
            $table->longText('profile');
            $table->string('image')->nullable();
            $table->dateTime('deletedAt')->nullable();
            $table->dateTime('updatedAt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person');
    }
}
