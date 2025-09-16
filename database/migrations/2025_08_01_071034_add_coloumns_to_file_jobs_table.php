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
            $table->boolean('already_registered')->default(false)->after('report_done');
            $table->decimal('fg_threshold', 8, 2)->nullable()->after('already_registered');
            $table->integer('eta_in_minutes')->nullable()->after('fg_threshold');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('file_jobs', function (Blueprint $table) {
            $table->dropColumn(['already_registered', 'fg_threshold', 'eta_in_minutes']);
        });
    }
};
