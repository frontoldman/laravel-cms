<?php

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
            $table->string('title',255);
            $table->string('link')->unique();
            $table->text('summary');
            $table->text('content');
            $table->boolean('active')->default(false);
            $table->integer('user_id')->unsigned();
            $table->timestamps();

        });

        Schema::table('posts',function(Blueprint $table){

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts',function(Blueprint $table){

            $table->dropForeign('post_user_id_foreign');

        });

        Schema::table('posts', function (Blueprint $table) {
            //
            $table->drop('posts');
        });
    }
}
