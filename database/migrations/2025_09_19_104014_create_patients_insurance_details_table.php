<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('patients_insurance_details', function (Blueprint $table) {
            $table->id(); // auto-increment BIGINT UNSIGNED PRIMARY KEY
            $table->bigInteger('patient_id')->unsigned()->index();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->string('present_subscriber_id', 255);
            $table->string('present_group', 100)->nullable();
            $table->string('present_payer_id', 100)->nullable();
            $table->string('present_address', 255);
            $table->string('present_phone', 100)->nullable();
            $table->string('present_fax', 100)->nullable();
            $table->date('present_effective_date')->nullable();
            $table->date('present_termination_date')->nullable();
            $table->string('secondary_subscriber_id', 255);
            $table->string('secondary_group', 100)->nullable();
            $table->string('secondary_payer_id', 100)->nullable();
            $table->string('secondary_address', 255);
            $table->string('secondary_phone', 100)->nullable();
            $table->string('secondary_fax', 100)->nullable();
            $table->date('secondary_effective_date')->nullable();
            $table->date('secondary_termination_date')->nullable();
            $table->string('tritary_subscriber_id', 255);
            $table->string('tritary_group', 100)->nullable();
            $table->string('tritary_payer_id', 100)->nullable();
            $table->string('tritary_address', 255);
            $table->string('tritary_phone', 100)->nullable();
            $table->string('tritary_fax', 100)->nullable();
            $table->date('tritary_effective_date')->nullable();

            $table->date('tritary_termination_date')->nullable();
            $table->timestamps(); // creates created_at and updated_at as nullable timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients_insurance_details');
    }
};
