<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('sample_files', function (Blueprint $table) {
            $table->unsignedBigInteger('product_sample_id')->nullable()->after('sample_order_id')->index();
        });
    }

    public function down(): void
    {
        Schema::table('sample_files', function (Blueprint $table) {
            $table->dropIndex(['product_sample_id']);
            $table->dropColumn('product_sample_id');
        });
    }
};
