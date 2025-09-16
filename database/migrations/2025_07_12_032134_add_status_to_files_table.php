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
        Schema::table('file', function (Blueprint $table) {
            $table->enum('status', ['1', '2', '3'])->default('1')->comment('1->Processing, 2->Completed, 3->Failed')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('file', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
