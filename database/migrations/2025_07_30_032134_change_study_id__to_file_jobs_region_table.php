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
        Schema::table('file_jobs_region', function (Blueprint $table) {
            $table->string('study_id')->change(); // Change from integer to varchar
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('file_jobs_region', function (Blueprint $table) {
            $table->unsignedBigInteger('study_id')->change(); // Revert back to integer
        });
    }
};
