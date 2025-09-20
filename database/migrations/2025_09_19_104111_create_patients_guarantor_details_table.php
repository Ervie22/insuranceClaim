<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('patients_guarantor_details', function (Blueprint $table) {
            $table->id(); // auto-increment BIGINT UNSIGNED PRIMARY KEY
            $table->bigInteger('patient_id')->unsigned()->index();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->string('first_name', 255);
            $table->string('last_name', 100)->nullable();
            $table->string('mi', 100)->nullable();
            $table->date('dob')->nullable();
            $table->enum('status', ['0', '1'])->default('1')->comment('0->no, 1->yes');
            $table->string('relationship', 100)->nullable();
            $table->string('homephone', 100)->nullable();
            $table->string('mobilephone', 100)->nullable();
            $table->string('email', 255)->unique();
            $table->string('address1', 100)->nullable();
            $table->string('address2', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('postcode', 100)->nullable();
            $table->timestamps(); // creates created_at and updated_at as nullable timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients_guarantor_details');
    }
};
