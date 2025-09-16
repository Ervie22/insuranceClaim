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
        Schema::create('file_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('study_id')->unique();
            // $table->foreign('file_id')->references('id')->on('files')->onDelete('set null');
            $table->enum('status', ['0', '1', '2', '3', '4', '5', '6'])->default('1')->comment('1->Pending, 2->Inprogress, 3->Processed, 4->Tiling, 5->Completed, 6->Error');
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_jobs');
    }
};
