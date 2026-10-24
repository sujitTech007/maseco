<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('orders', 'uid')) {
            return;
        }

        // Clear first so the unique index cannot conflict with UIDs from the old format.
        DB::table('orders')->update(['uid' => null]);

        DB::table('orders')->orderBy('id')->chunkById(200, function ($orders) {
            foreach ($orders as $order) {
                DB::table('orders')->where('id', $order->id)->update([
                    'uid' => 'ORD' . str_pad((string) $order->id, 4, '0', STR_PAD_LEFT),
                ]);
            }
        });
    }

    public function down(): void
    {
        // Order UIDs are identifiers and are intentionally not reverted.
    }
};
