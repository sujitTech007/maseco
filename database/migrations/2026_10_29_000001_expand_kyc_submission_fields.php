<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('kyc_submissions', function (Blueprint $table) {
            $table->string('address_document')->nullable()->change();
            $table->string('document_back')->nullable();
            $table->string('selfie_document')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('document_type')->nullable();
            $table->string('document_number')->nullable();
            $table->json('form_data')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('kyc_submissions', function (Blueprint $table) {
            $table->string('address_document')->nullable(false)->change();
            $table->dropColumn(['document_back', 'selfie_document', 'profile_photo', 'document_type', 'document_number', 'form_data']);
        });
    }
};
