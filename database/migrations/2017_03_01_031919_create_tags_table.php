<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();

            // not unique because users may have tags of the same name
            // and we don't want to share because they may be renamed
            $table->string('name');

            $table->integer('created_by_user_id')->unsigned()->nullable();
            $table->foreign('created_by_user_id')
                ->references('id')
                ->on('users');

            $table->unique(['name', 'created_by_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
