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
        Schema::table('questions', function (Blueprint $table) {
            $table->unsignedBigInteger('monitoring_sheet_id');
            $table->index('monitoring_sheet_id');
            $table->foreign('monitoring_sheet_id')
                ->references('id')
                ->on('monitoring_sheets')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropIndex(['monitoring_sheet_id']);
            $table->dropForeign(['monitoring_sheet_id']);
            $table->dropColumn('monitoring_sheet_id');
        });
    }
};
