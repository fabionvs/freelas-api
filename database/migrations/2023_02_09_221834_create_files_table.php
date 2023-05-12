<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file');
            $table->string('link')->unique();
            $table->string('format');
            $table->boolean('private')->default(false);
            $table->boolean('active')->default(false);
            $table->boolean('checked')->default(false);
            $table->boolean('has_virus')->default(false);
            $table->boolean('has_copyright')->default(false);
            $table->boolean('allowed_copyright')->default(false);
            $table->boolean('ban')->default(false);
            $table->string('ban_description')->nullable();
            $table->timestamps();

            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('tb_users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_files');
    }
}
