<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('materials', 'is_certified')) {
            Schema::table('materials', function (Blueprint $table) {
                $table->boolean('is_certified')->default(false);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('materials', 'is_certified')) {
            Schema::table('materials', function (Blueprint $table) {
                $table->dropColumn('is_certified');
            });
        }
    }
};
