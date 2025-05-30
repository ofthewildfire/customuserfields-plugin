<?php namespace ofthewildfire\academyusers\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateAcademyUserFields extends Migration
{
    public function up()
    {
        Schema::table('users', function($table)
        {
            if (!Schema::hasColumn('users', 'organization')) {
                $table->string('organization')->nullable();
            }
            if (!Schema::hasColumn('users', 'city_state')) {
                $table->string('city_state')->nullable();
            }
            if (!Schema::hasColumn('users', 'reason_for_joining')) {
                $table->text('reason_for_joining')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function($table)
        {
            if (Schema::hasColumn('users', 'organization')) {
                $table->dropColumn('organization');
            }
            if (Schema::hasColumn('users', 'city_state')) {
                $table->dropColumn('city_state');
            }
            if (Schema::hasColumn('users', 'reason_for_joining')) {
                $table->dropColumn('reason_for_joining');
            }
        });
    }
} 