<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('type');
            $table->string('spec_type');
            $table->integer('visits');
            $table->integer('album_id')->unsigned()->index()->nullable();
            $table->foreign('album_id')->references('id')->on('albums');
            $table->integer('video_id')->unsigned()->index()->nullable();
            $table->foreign('video_id')->references('id')->on('video_posts');
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
