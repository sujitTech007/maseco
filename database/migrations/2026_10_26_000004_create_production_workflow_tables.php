<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('production_projects')) Schema::create('production_projects', function (Blueprint $table) {
            $table->id(); $table->foreignId('order_id')->unique()->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('created_by_id'); $table->string('created_by_type', 24);
            $table->unsignedTinyInteger('progress')->default(0); $table->string('status', 24)->default('pending')->index();
            $table->string('stage')->nullable(); $table->date('start_date')->nullable(); $table->date('expected_completion_date')->nullable();
            $table->timestamps();
        });
        if (!Schema::hasTable('production_progress_histories')) Schema::create('production_progress_histories', function (Blueprint $table) {
            $table->id(); $table->foreignId('production_project_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('previous_progress'); $table->unsignedTinyInteger('new_progress');
            $table->string('previous_status', 24)->nullable(); $table->string('new_status', 24);
            $table->unsignedBigInteger('user_id'); $table->string('user_type', 24); $table->text('notes')->nullable(); $table->timestamps();
        });
        if (!Schema::hasTable('production_milestones')) Schema::create('production_milestones', function (Blueprint $table) {
            $table->id(); $table->foreignId('production_project_id')->constrained()->cascadeOnDelete();
            $table->string('title'); $table->text('description')->nullable(); $table->date('due_date')->nullable();
            $table->unsignedBigInteger('assigned_user_id')->nullable(); $table->string('assigned_user_type', 24)->nullable();
            $table->string('status', 24)->default('pending')->index(); $table->text('notes')->nullable(); $table->timestamp('completed_at')->nullable(); $table->timestamps();
            $table->index(['production_project_id','due_date']);
        });
        else {
            Schema::table('production_milestones', function (Blueprint $table) {
                if (!Schema::hasColumn('production_milestones', 'production_project_id')) $table->unsignedBigInteger('production_project_id')->nullable()->index();
                if (!Schema::hasColumn('production_milestones', 'description')) $table->text('description')->nullable();
                if (!Schema::hasColumn('production_milestones', 'assigned_user_id')) $table->unsignedBigInteger('assigned_user_id')->nullable();
                if (!Schema::hasColumn('production_milestones', 'assigned_user_type')) $table->string('assigned_user_type',24)->nullable();
                if (!Schema::hasColumn('production_milestones', 'notes')) $table->text('notes')->nullable();
                if (!Schema::hasColumn('production_milestones', 'completed_at')) $table->timestamp('completed_at')->nullable();
            });
            if (Schema::hasColumn('production_milestones', 'details') && Schema::hasColumn('production_milestones', 'description')) {
                \Illuminate\Support\Facades\DB::table('production_milestones')->whereNull('description')->update(['description' => \Illuminate\Support\Facades\DB::raw('details')]);
            }
            if (Schema::hasColumn('production_milestones', 'order_id')) {
                \Illuminate\Support\Facades\DB::table('production_milestones')->whereNull('production_project_id')->orderBy('id')->get()->each(function ($milestone) {
                    $projectId = \Illuminate\Support\Facades\DB::table('production_projects')->where('order_id', $milestone->order_id)->value('id');
                    if ($projectId) \Illuminate\Support\Facades\DB::table('production_milestones')->where('id', $milestone->id)->update(['production_project_id' => $projectId]);
                });
            }
        }
        if (!Schema::hasTable('production_sample_submissions')) Schema::create('production_sample_submissions', function (Blueprint $table) {
            $table->id(); $table->foreignId('production_project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_sample_id')->constrained('product_samples')->cascadeOnDelete();
            $table->unsignedBigInteger('submitted_by_id'); $table->string('submitted_by_type', 24); $table->unsignedInteger('revision')->default(1);
            $table->string('status', 24)->default('pending')->index(); $table->text('submission_notes')->nullable(); $table->timestamps();
        });
        if (!Schema::hasTable('production_sample_reviews')) Schema::create('production_sample_reviews', function (Blueprint $table) {
            $table->id(); $table->foreignId('submission_id')->constrained('production_sample_submissions')->cascadeOnDelete();
            $table->unsignedBigInteger('reviewer_id'); $table->string('reviewer_type', 24); $table->string('decision', 24); $table->text('feedback')->nullable(); $table->timestamp('reviewed_at'); $table->timestamps();
        });
        if (!Schema::hasTable('production_comments')) Schema::create('production_comments', function (Blueprint $table) {
            $table->id(); $table->foreignId('production_project_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('author_id'); $table->string('author_type', 24); $table->text('body'); $table->timestamps();
        });
        if (!Schema::hasTable('production_project_files')) Schema::create('production_project_files', function (Blueprint $table) {
            $table->id(); $table->foreignId('production_project_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('uploaded_by_id'); $table->string('uploaded_by_type', 24); $table->string('path'); $table->string('filename'); $table->string('mime_type',120)->nullable(); $table->unsignedBigInteger('size')->default(0); $table->string('title'); $table->timestamps();
        });
        if (!Schema::hasTable('production_deliveries')) Schema::create('production_deliveries', function (Blueprint $table) {
            $table->id(); $table->foreignId('production_project_id')->constrained()->cascadeOnDelete();
            $table->text('address'); $table->date('expected_date'); $table->text('instructions')->nullable();
            $table->unsignedBigInteger('responsible_user_id'); $table->string('responsible_user_type',24); $table->string('status',24)->default('scheduled')->index(); $table->timestamps();
        });
        if (!Schema::hasTable('production_delivery_histories')) Schema::create('production_delivery_histories', function (Blueprint $table) {
            $table->id(); $table->foreignId('delivery_id')->constrained('production_deliveries')->cascadeOnDelete(); $table->date('previous_date')->nullable(); $table->date('new_date'); $table->unsignedBigInteger('changed_by_id'); $table->string('changed_by_type',24); $table->text('note')->nullable(); $table->timestamps();
        });
        if (!Schema::hasTable('production_shipments')) Schema::create('production_shipments', function (Blueprint $table) {
            $table->id(); $table->foreignId('production_project_id')->constrained()->cascadeOnDelete(); $table->string('carrier')->nullable(); $table->string('tracking_number')->nullable(); $table->string('tracking_url')->nullable(); $table->date('shipment_date')->nullable(); $table->date('expected_delivery_date')->nullable(); $table->text('package_details')->nullable(); $table->text('notes')->nullable(); $table->string('status',24)->default('preparing')->index(); $table->timestamps();
        });
        if (!Schema::hasTable('production_shipment_histories')) Schema::create('production_shipment_histories', function (Blueprint $table) {
            $table->id(); $table->foreignId('shipment_id')->constrained('production_shipments')->cascadeOnDelete(); $table->string('status',24); $table->unsignedBigInteger('changed_by_id'); $table->string('changed_by_type',24); $table->text('notes')->nullable(); $table->timestamps();
        });
        if (!Schema::hasTable('production_meetings')) Schema::create('production_meetings', function (Blueprint $table) {
            $table->id(); $table->foreignId('production_project_id')->constrained()->cascadeOnDelete(); $table->string('title'); $table->dateTime('starts_at'); $table->string('meeting_url')->nullable(); $table->unsignedBigInteger('created_by_id'); $table->string('created_by_type',24); $table->timestamps();
        });
        if (!Schema::hasTable('production_activities')) Schema::create('production_activities', function (Blueprint $table) {
            $table->id(); $table->foreignId('production_project_id')->constrained()->cascadeOnDelete(); $table->unsignedBigInteger('actor_id')->nullable(); $table->string('actor_type',24)->nullable(); $table->string('event',80); $table->text('description'); $table->timestamps(); $table->index(['production_project_id','created_at']);
        });
    }

    public function down(): void
    {
        foreach (['production_activities','production_meetings','production_shipment_histories','production_shipments','production_delivery_histories','production_deliveries','production_project_files','production_comments','production_sample_reviews','production_sample_submissions','production_milestones','production_progress_histories','production_projects'] as $table) Schema::dropIfExists($table);
    }
};
