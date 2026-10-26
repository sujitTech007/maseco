<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_samples', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id')->index();
            $table->unsignedBigInteger('supplier_id')->nullable()->index();
            $table->unsignedBigInteger('manufacturer_id')->nullable()->index();
            $table->string('name'); $table->text('description')->nullable(); $table->text('specifications')->nullable();
            $table->decimal('price', 12, 2); $table->decimal('shipping_fee', 12, 2)->default(0);
            $table->unsignedInteger('stock_quantity')->default(0); $table->unsignedInteger('processing_days')->default(0);
            $table->string('image_path')->nullable(); $table->string('status', 20)->default('inactive')->index();
            $table->timestamps();
        });

        Schema::create('sample_orders', function (Blueprint $table) {
            $table->id(); $table->string('reference', 40)->unique();
            $table->unsignedBigInteger('buyer_id')->index(); $table->unsignedBigInteger('original_order_id')->nullable()->index();
            $table->unsignedBigInteger('product_sample_id')->index(); $table->unsignedBigInteger('material_id')->index();
            $table->unsignedBigInteger('supplier_id')->nullable()->index(); $table->unsignedBigInteger('manufacturer_id')->nullable()->index();
            $table->unsignedInteger('quantity'); $table->decimal('unit_price', 12, 2); $table->decimal('subtotal', 12, 2);
            $table->decimal('shipping_fee', 12, 2); $table->decimal('tax_amount', 12, 2)->default(0);
            $table->decimal('discount_amount', 12, 2)->default(0); $table->decimal('total_amount', 12, 2);
            $table->string('payment_status', 30)->default('pending')->index(); $table->string('order_status', 30)->default('awaiting_approval')->index();
            $table->text('shipping_address'); $table->string('tracking_number')->nullable(); $table->string('courier')->nullable();
            $table->text('shipping_document_path')->nullable(); $table->string('stripe_session_id')->nullable()->unique();
            $table->string('transaction_id')->nullable()->unique(); $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });

        Schema::create('sample_files', function (Blueprint $table) {
            $table->id(); $table->unsignedBigInteger('order_id')->nullable()->index(); $table->unsignedBigInteger('sample_order_id')->nullable()->index();
            $table->unsignedBigInteger('uploaded_by_id')->index(); $table->string('uploaded_by_type', 24);
            $table->string('recipient_type', 24)->nullable(); $table->unsignedBigInteger('recipient_id')->nullable();
            $table->string('file_path'); $table->string('original_filename'); $table->string('mime_type', 120)->nullable();
            $table->unsignedBigInteger('file_size')->default(0); $table->string('title'); $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('sample_messages', function (Blueprint $table) {
            $table->id(); $table->unsignedBigInteger('order_id')->nullable()->index(); $table->unsignedBigInteger('sample_order_id')->nullable()->index();
            $table->unsignedBigInteger('sender_id')->index(); $table->string('sender_type', 24); $table->text('message');
            $table->unsignedBigInteger('sample_file_id')->nullable()->index(); $table->timestamps();
        });

        Schema::create('sample_order_status_logs', function (Blueprint $table) {
            $table->id(); $table->unsignedBigInteger('sample_order_id')->index(); $table->string('old_status', 30)->nullable();
            $table->string('new_status', 30); $table->unsignedBigInteger('changed_by_id'); $table->string('changed_by_type', 24); $table->text('note')->nullable(); $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sample_order_status_logs'); Schema::dropIfExists('sample_messages');
        Schema::dropIfExists('sample_files'); Schema::dropIfExists('sample_orders'); Schema::dropIfExists('product_samples');
    }
};
