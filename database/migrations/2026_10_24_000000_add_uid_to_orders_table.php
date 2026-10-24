<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('orders', 'uid')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('uid', 32)->nullable()->unique();
            });
        }

        DB::table('orders')->whereNull('uid')->orderBy('id')->chunkById(200, function ($orders) {
            foreach ($orders as $order) {
                DB::table('orders')->where('id', $order->id)->update([
                    'uid' => 'ORD' . str_pad((string) $order->id, 4, '0', STR_PAD_LEFT),
                ]);
            }
        });
    }

    public function down(): void
    {
        if (Schema::hasColumn('orders', 'uid')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropUnique(['uid']);
                $table->dropColumn('uid');
            });
        }
    }
};
