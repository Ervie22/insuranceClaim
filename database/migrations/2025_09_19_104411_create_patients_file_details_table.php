<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('patients_file_details', function (Blueprint $table) {
            $table->id(); // auto-increment BIGINT UNSIGNED PRIMARY KEY
            $table->bigInteger('patient_id')->unsigned()->index();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->string('pcp_name', 255);
            $table->string('npi', 100)->nullable();
            $table->string('abn', 100)->nullable();
            $table->string('privacy_notice', 255);
            $table->string('roi', 100)->nullable();
            $table->string('language', 100)->nullable();
            $table->string('race', 100)->nullable();
            $table->string('ethnicity', 100)->nullable();
            $table->string('marital_status', 100)->nullable();
            $table->string('gender', 100)->nullable();
            $table->string('method_of_contact', 100)->nullable();
            $table->timestamps(); // creates created_at and updated_at as nullable timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients_file_details');
    }
};
