<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_business', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('hashtags');
            $table->string('website')->nullable();
            $table->json('horarios')->nullable();
            $table->json('info_adicionais')->nullable();
            $table->string('latitude')->unique()->nullable();
            $table->string('longitude')->unique()->nullable();

            $table->timestamps();

            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('tb_users')->onUpdate('cascade')->onDelete('cascade');

            $table->bigInteger('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('tb_category')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_business');
    }
}
