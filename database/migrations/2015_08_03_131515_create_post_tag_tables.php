<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTagTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->integer('tag_id')->unsigned();
        });

        Schema::table('post_tag',function(Blueprint $table){

            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDetete('restrict')
                ->onUpdate('restrict');

            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDetete('restrict')
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

        Schema::table('post_tag',function(Blueprint $table){

            $table->dropForeign('post_tag_post_id_foreign');
            $table->dropForeign('post_tag_tag_id_foreign');

        });

        Schema::drop('post_tag');
    }
}
