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
        Schema::create('monitoring_sheet_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->timestamps();
        });

        Schema::create('monitoring_sheets', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->string('division');
            $table->string('coverage')->nullable();
            $table->string('year_quarter')->nullable();
            $table->string('prepared_by')->nullable();
            $table->string('checked_by')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->index(['user_id']);
            $table->index(['category_id']);

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->foreign('category_id')->references('id')
                ->on('monitoring_sheet_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_sheets');
        Schema::dropIfExists('monitoring_sheet_categories');
    }
};
