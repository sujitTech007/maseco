<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kyc_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('account_type', 20)->index();
            $table->unsignedBigInteger('account_id')->index();
            $table->string('identity_document');
            $table->string('address_document');
            $table->string('business_document')->nullable();
            $table->string('tax_document')->nullable();
            $table->string('status', 20)->default('incomplete')->index();
            $table->text('admin_note')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
            $table->unique(['account_type', 'account_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kyc_submissions');
    }
};
