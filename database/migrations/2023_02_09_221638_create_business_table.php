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
            $table->string('google_business_link');
            $table->string('link')->unique();
            $table->json('properties')->nullable();
            $table->json('stats')->nullable();
            $table->json('levels')->nullable();
            $table->boolean('explicit');
            $table->boolean('public_chat');

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
