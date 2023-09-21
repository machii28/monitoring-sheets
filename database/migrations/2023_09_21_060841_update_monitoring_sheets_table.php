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
            $table->string('process')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();

            $table->index('area_id');
            $table->foreign('area_id')
                ->references('id')
                ->on('areas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monitoring_sheets', function (Blueprint $table) {
            $table->string('process')->nullable();
        });
    }
};
