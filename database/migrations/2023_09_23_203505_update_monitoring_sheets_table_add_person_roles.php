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
        Schema::table('monitoring_sheets', function (Blueprint $table) {
            $table->string('prepared_by_role')->after('prepared_by')->nullable();
            $table->string('checked_by_role')->after('checked_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monitoring_sheets', function (Blueprint $table) {
            $table->dropColumn('prepared_by_role');
            $table->dropColumn('checked_by_role');
        });
    }
};
