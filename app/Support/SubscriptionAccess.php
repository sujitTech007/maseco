<?php

namespace App\Support;

use App\Models\SubscriptionPurchase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SubscriptionAccess
{
    public static function hasActive(string $accountType, int $accountId): bool
    {
        $today = now()->toDateString();

        if ($accountType === 'buyer') {
            return SubscriptionPurchase::where('user_id', $accountId)
                ->where('payment_status', 'paid')->where('is_active', true)
                ->whereDate('start_date', '<=', $today)->whereDate('end_date', '>=', $today)->exists();
        }

        $table = match ($accountType) {
            'supplier' => 'supplier_subscription_purchases',
            'manufacturer' => 'manufacturer_subscription_purchases',
            default => null,
        };
        if (!$table || !Schema::hasTable($table)) return false;

        return DB::table($table)->where($accountType.'_id', $accountId)
            ->where('payment_status', 'paid')->where('is_active', true)
            ->whereDate('start_date', '<=', $today)->whereDate('end_date', '>=', $today)->exists();
    }
}
