<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();

            $table->string('filename')->unique();
            $table->string('mnt');

            $table->string('title')->nullable();
            $table->string('imdb_id')->unique()->nullable();
            $table->text('description')->nullable();
            $table->date('released_on')->nullable();
            $table->unsignedInteger('runtime_minutes')->nullable();
            $table->string('country')->nullable();
            $table->string('language')->nullable();
            $table->string('poster')->nullable();
        });

        DB::unprepared("
            CREATE TRIGGER movies_default_title
            BEFORE INSERT ON movies FOR EACH ROW
                IF NEW.title IS NULL THEN
                    SET NEW.title := NEW.filename;
                END IF;;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
