<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerNewUserDefaults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_user_defaults
            AFTER INSERT ON `users`
            FOR EACH ROW BEGIN
                INSERT INTO tags
                    (`name`, `created_by_user_id`, `created_at`)
                VALUES
                    ('blocked', NEW.id, NOW()),
                    ('starred', NEW.id, NOW()),
                    ('watched', NEW.id, NOW());

                -- saves the default home view as no blocked tags
                INSERT INTO vistas
                    (`name`, `path`, `user_id`, `created_at`)
                VALUES (
                    'Home',
                    CONCAT(
                        '/movies?nottags%5B%5D=',
                        CAST(LAST_INSERT_ID() AS CHAR)
                    ),
                    NEW.id,
                    NOW()
                );
            END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_user_defaults`');
    }
}
