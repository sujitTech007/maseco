<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('enquiry_meetings')) {
            Schema::create('enquiry_meetings', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('enquiry_id')->index();
                $table->string('title', 180);
                $table->dateTime('starts_at')->index();
                $table->string('meeting_url', 1000)->nullable();
                $table->unsignedBigInteger('created_by_id');
                $table->string('created_by_type', 24);
                $table->timestamps();
                $table->index(['enquiry_id', 'starts_at']);
            });
        }
    }

    public function down(): void { Schema::dropIfExists('enquiry_meetings'); }
};
