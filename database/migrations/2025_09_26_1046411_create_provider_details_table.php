<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('provider_details', function (Blueprint $table) {
            $table->id(); // auto-increment BIGINT UNSIGNED PRIMARY KEY
            $table->string('provider_first_name', 255);
            $table->string('provider_last_name', 100)->nullable();
            $table->string('caqh_id', 100)->nullable();
            $table->enum('status', ['0', '1'])->default('1')->comment('0->no, 1->yes');
            $table->string('role', 100)->nullable();
            $table->string('speciality', 100)->nullable();
            $table->string('degree', 100)->nullable();
            $table->string('individual_npi', 100)->nullable();
            $table->string('individual_ptan', 100)->nullable();
            $table->json('setup_options')->nullable();

            $table->bigInteger('created_by');
            $table->bigInteger('updated_by')->nullable();
            $table->enum('is_deleted', ['0', '1'])->default('0')->comment('0->no, 1->yes');
            $table->timestamps(); // creates created_at and updated_at as nullable timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provider_details');
    }
};
