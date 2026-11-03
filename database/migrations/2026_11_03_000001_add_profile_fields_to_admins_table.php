<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('admins')) {
            return;
        }

        Schema::table('admins', function (Blueprint $table) {
            if (!Schema::hasColumn('admins', 'phone')) {
                $table->string('phone', 30)->nullable();
            }
            if (!Schema::hasColumn('admins', 'country_code')) {
                $table->string('country_code', 10)->nullable();
            }
            if (!Schema::hasColumn('admins', 'country')) {
                $table->string('country', 100)->nullable();
            }
            if (!Schema::hasColumn('admins', 'state')) {
                $table->string('state', 100)->nullable();
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('admins')) {
            return;
        }

        $columns = array_values(array_filter(
            ['phone', 'country_code', 'country', 'state'],
            fn (string $column) => Schema::hasColumn('admins', $column)
        ));

        if ($columns) {
            Schema::table('admins', function (Blueprint $table) use ($columns) {
                $table->dropColumn($columns);
            });
        }
    }
};
