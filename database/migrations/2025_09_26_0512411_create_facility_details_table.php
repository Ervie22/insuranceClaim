<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('facility_details', function (Blueprint $table) {
            $table->id(); // auto-increment BIGINT UNSIGNED PRIMARY KEY
            $table->string('group_name', 255);
            $table->string('group_npi', 100)->nullable();
            $table->string('group_taxid', 100)->nullable();
            $table->string('group_ptan', 100)->nullable();
            $table->string('group_phone', 100)->nullable();
            $table->string('group_fax', 100)->nullable();
            $table->string('address1', 100)->nullable();
            $table->string('address2', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('postcode', 100)->nullable();
            $table->text('notes', 100)->nullable();
            $table->enum('active', ['0', '1'])->default('1')->comment('0->no, 1->yes');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by')->nullable();
            $table->enum('is_deleted', ['0', '1'])->default('0')->comment('0->no, 1->yes');
            $table->timestamps(); // creates created_at and updated_at as nullable timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facility_details');
    }
};
