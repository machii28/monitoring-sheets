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
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('monitoring_sheets', function (Blueprint $table) {
            $table->dropColumn('division');
            $table->unsignedBigInteger('division_id');
            $table->foreign('division_id')
                ->references('id')
                ->on('divisions')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monitoring_sheets', function (Blueprint $table) {
            $table->string('division');
            $table->dropForeign(['division_id']);
            $table->dropColumn('division_id');
        });

        Schema::dropIfExists('divisions');
    }
};
