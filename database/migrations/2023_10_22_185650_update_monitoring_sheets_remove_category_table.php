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
            $table->dropForeign(['category_id']);

            $table->dropColumn('category_id');

            $table->enum('category', [
                'fqo',
                'rr',
                'pg'
            ]);
        });

        Schema::dropIfExists('monitoring_sheet_categories');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
