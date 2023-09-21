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
        Schema::create('monitoring_sheets_answers', function (Blueprint $table) {
            $table->id();
            $table->string('answer');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('monitoring_sheet_id');

            $table->index('user_id');
            $table->index('question_id');
            $table->index('monitoring_sheet_id');

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->foreign('question_id')->references('id')
                ->on('questions')->onDelete('cascade');
            $table->foreign('monitoring_sheet_id')
                ->references('id')
                ->on('monitoring_sheets')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_sheets_answers');
    }
};
