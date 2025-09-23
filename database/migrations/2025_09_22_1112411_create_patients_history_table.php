<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('patients_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable(); // nullable if guest
            $table->string('user_name')->nullable();
            $table->longText('action')->nullable(); // e.g. 'updated_patient', 'viewed_record'
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->string('ip_address', 45)->nullable(); // IPv6 safe
            $table->string('user_agent', 1000)->nullable();
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('isp')->nullable();
            $table->json('raw_geo')->nullable(); // store provider response if needed
            $table->text('notes')->nullable(); // extra info
            $table->timestamps();

            $table->index('user_id');
            $table->index('patient_id');
            $table->index('ip_address');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients_history');
    }
};
