<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('admins') && !Schema::hasColumn('admins', 'profile_image')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->string('profile_image')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('admins') && Schema::hasColumn('admins', 'profile_image')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->dropColumn('profile_image');
            });
        }
    }
};
