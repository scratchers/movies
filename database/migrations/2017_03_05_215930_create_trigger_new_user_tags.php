<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerNewUserTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER tr_user_default_tags
            AFTER INSERT ON `users`
            FOR EACH ROW BEGIN
                INSERT INTO tags
                    (`name`, `created_by_user_id`, `created_at`)
                VALUES
                    ('watched', NEW.id, NOW()),
                    ('blocked', NEW.id, NOW()),
                    ('starred', NEW.id, NOW());
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
        DB::unprepared('DROP TRIGGER `tr_user_default_tags`');
    }
}
