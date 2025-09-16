<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileJobsRegionTable extends Migration
{
    public function up()
    {
        Schema::create('file_jobs_region', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('file_jobs_id')->unique();
            $table->foreign('file_jobs_id')->references('id')->on('file_jobs')->onDelete('cascade');
            $table->string('region'); // Format: x,y,l,b (e.g., "12,34,56,78")
            $table->timestamps();

            // Optional: if file_jobs is another table, add foreign key
            // $table->foreign('file_jobs_id')->references('id')->on('file_jobs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('file_jobs_region');
    }
}
