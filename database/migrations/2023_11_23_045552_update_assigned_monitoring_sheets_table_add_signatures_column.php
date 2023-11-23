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
        Schema::table('assigned_monitoring_sheets', function (Blueprint $table) {
            $table->string('prepared_by_signature')->nullable();
            $table->string('checked_by_signature')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assigned_monitoring_sheets', function (Blueprint $table) {
            $table->dropColumn('prepared_by_signature');
            $table->dropColumn('checked_by_signature');
        });
    }
};
