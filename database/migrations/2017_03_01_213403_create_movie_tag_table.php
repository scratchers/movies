<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovieTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_tag', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();

            $table->integer('movie_id')->unsigned();
            $table->foreign('movie_id')
                ->references('id')
                ->on('movies')
                ->onDelete('cascade');

            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');

            $table->primary(['tag_id', 'movie_id']);
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_tag');
    }
}
