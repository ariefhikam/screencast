<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class First extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // first migration

        Schema::create('tag', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('display_name')->nullable();
            $table->timestamps();
        });

        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('series', function (Blueprint $table) {
            $table->increments('id');
            $table->string('display_name');
            $table->string('permalink')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });

        Schema::create('profile', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->text('image')->nullable();
            $table->text('about')->nullable();
            $table->enum('gender', ['l', 'p'])->nullable();
            $table->string('phone')->nullable();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });

        Schema::create('issues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('message')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('no action');

            $table->foreign('category_id')
                  ->references('id')
                  ->on('category')
                  ->onDelete('no action');
        });

        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('display_name');
            $table->string('permalink')->nullable();
            $table->text('description')->nullable();
            $table->text('url')->nullable();
            $table->decimal('price', 9, 2);
            $table->integer('series_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->timestamps();

            $table->foreign('series_id')
                  ->references('id')
                  ->on('series')
                  ->onDelete('cascade');

            $table->foreign('users_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });

        Schema::create('lessons_tag', function (Blueprint $table) {
            $table->integer('lesson_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            $table->foreign('lesson_id')
                  ->references('id')
                  ->on('lessons')
                  ->onDelete('cascade');
            $table->foreign('tag_id')
                  ->references('id')
                  ->on('tag')
                  ->onDelete('cascade');

            $table->primary(['lesson_id', 'tag_id']);
        });

        Schema::create('users_lessons', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('lesson_id')->unsigned();

            $table->foreign('lesson_id')
                  ->references('id')
                  ->on('lessons')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->primary(['lesson_id', 'user_id']);
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from')->unsigned()->nullable();
            $table->integer('to')->unsigned()->nullable();

            $table->timestamps();

            $table->text('messages')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
         Schema::dropIfExists('messages');
         Schema::dropIfExists('users_lessons');
         Schema::dropIfExists('lessons_tag');
         Schema::dropIfExists('lessons');
         Schema::dropIfExists('issues');
         Schema::dropIfExists('profile');
         Schema::dropIfExists('series');
         Schema::dropIfExists('category');
         Schema::dropIfExists('tag');
    }
}
