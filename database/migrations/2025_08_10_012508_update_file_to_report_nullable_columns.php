<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('file_to_report', function (Blueprint $table) {
            $table->string('study_id', 255)->nullable()->change();
            $table->string('her2', 255)->nullable()->change();
            $table->string('ki67', 255)->nullable()->change();
            $table->string('er', 255)->nullable()->change();
            $table->string('pgr', 255)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('file_to_report', function (Blueprint $table) {
            $table->string('study_id', 255)->nullable(false)->change();
            $table->string('her2', 255)->nullable(false)->change();
            $table->string('ki67', 255)->nullable(false)->change();
            $table->string('er', 255)->nullable(false)->change();
            $table->string('pgr', 255)->nullable(false)->change();
        });
    }
};