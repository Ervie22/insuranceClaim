<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFolderNameToFileJobsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('file_jobs', function (Blueprint $table) {
            $table->string('folder_name', 255)->after('id');
            $table->string('study_name', 255)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('file_jobs', function (Blueprint $table) {
            $table->dropColumn('folder_name');
            $table->dropColumn('study_name');
        });
    }
}
