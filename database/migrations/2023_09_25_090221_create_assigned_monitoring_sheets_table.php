<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('monitoring_sheet_answers');
        Schema::create('assigned_monitoring_sheets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('monitoring_sheet_id');
            $table->unsignedBigInteger('assigned_id');
            $table->unsignedBigInteger('assigned_by');
            $table->boolean('is_filled_up')->default(false);

            $table->index('monitoring_sheet_id');
            $table->index('assigned_id');
            $table->index('assigned_by');

            $table->foreign('monitoring_sheet_id')->references('id')
                ->on('monitoring_sheets')->onDelete('cascade');
            $table->foreign('assigned_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->foreign('assigned_by')->references('id')
                ->on('users')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('monitoring_sheet_answers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('assigned_monitoring_sheet_id');
            $table->unsignedBigInteger('question_id');
            $table->text('status')->nullable();
            $table->text('remarks')->nullable();
            $table->text('root_cause')->nullable();
            $table->text('corrective_action')->nullable();

            $table->index('assigned_monitoring_sheet_id');
            $table->index('question_id');

            $table->foreign('assigned_monitoring_sheet_id')->references('id')
                ->on('assigned_monitoring_sheets')->onDelete('cascade');
            $table->foreign('question_id')->references('id')
                ->on('questions')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('process_id')->nullable()->after('area_id');
        });

        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('monitoring_sheets', function (Blueprint $table) {
            $table->unsignedBigInteger('process_id')->nullable();

            $table->index('process_id');
            $table->foreign('process_id')
                ->references('id')
                ->on('processes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_sheet_answers');
        Schema::dropIfExists('assigned_monitoring_sheets');
        Schema::dropIfExists('processes');
    }
};
