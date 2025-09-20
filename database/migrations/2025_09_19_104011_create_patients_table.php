<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id(); // auto-increment BIGINT UNSIGNED PRIMARY KEY
            $table->string('first_name', 255);
            $table->string('last_name', 100)->nullable();
            $table->string('mi', 100)->nullable();
            $table->date('dob')->nullable();
            $table->string('sex', 100)->nullable();
            $table->string('ssn', 100)->nullable();
            $table->string('homephone', 100)->nullable();
            $table->string('mobilephone', 100)->nullable();
            $table->string('email', 255)->unique();
            $table->string('address1', 100)->nullable();
            $table->string('address2', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('postcode', 100)->nullable();
            $table->text('notes', 100)->nullable();
            $table->string('profile_image_path', 255)->nullable();
            $table->enum('active', ['0', '1'])->default('1')->comment('0->no, 1->yes');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by')->nullable();
            $table->timestamps(); // creates created_at and updated_at as nullable timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
