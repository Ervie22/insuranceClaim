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
        Schema::table('file_jobs', function (Blueprint $table) {
            $table->boolean('find_tumor')->default(true)->after('eta_in_minutes');
            $table->boolean('trigger_analysis')->default(false)->after('find_tumor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('file_jobs', function (Blueprint $table) {
            $table->dropColumn(['find_tumor', 'trigger_analysis']);
        });
    }
};
