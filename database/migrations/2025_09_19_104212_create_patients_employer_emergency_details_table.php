<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('patients_employer_emergency_details', function (Blueprint $table) {
            $table->id(); // auto-increment BIGINT UNSIGNED PRIMARY KEY
            $table->bigInteger('patient_id')->unsigned()->index();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->string('employer_name', 255);
            $table->string('department', 100)->nullable();
            $table->string('employer_phone', 100)->nullable();
            $table->string('email', 255);
            $table->string('address1', 100)->nullable();
            $table->string('address2', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('postcode', 100)->nullable();
            $table->string('emergency_contact', 100)->nullable();
            $table->string('relationship', 100)->nullable();
            $table->string('kin_phone', 100)->nullable();
            $table->string('kin_address', 255);

            $table->timestamps(); // creates created_at and updated_at as nullable timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients_employer_emergency_details');
    }
};
