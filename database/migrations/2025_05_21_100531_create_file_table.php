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
        Schema::create('file', function (Blueprint $table) {
            $table->id();
            $table->string('study_name', 255);
            $table->text('study_description');
            $table->date('upload_date')->nullable();
            $table->string('study_id')->nullable();
            $table->string('file_name', 255);

            // Updated: Renamed to file_type_id for consistency with foreign key
            $table->unsignedBigInteger('file_type_id')->nullable();
            $table->foreign('file_type_id')->references('id')->on('file_types')->onDelete('set null');

            $table->string('file_path', 255);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('result_url', 1024)->nullable();
            $table->enum('active', ['0', '1'])->default('1')->comment('0->no, 1->yes');
            $table->enum('is_deleted', ['0', '1'])->default('1')->comment('0->no, 1->yes');

            $table->timestamps();

            // ✅ Index on study_id
            $table->index('study_id');

            // ✅ Unique composite index on study_id and file_type_id
            $table->unique(['study_id', 'file_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
