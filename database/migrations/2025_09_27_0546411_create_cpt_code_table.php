<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cpt_code', function (Blueprint $table) {
            $table->id(); // auto-increment BIGINT UNSIGNED PRIMARY KEY
            $table->string('cpt', 255);
            $table->string('description', 255)->nullable();
            $table->decimal('Medicare_OH_Fee_DEMO', 10, 2)->nullable();
            $table->decimal('Medicaid_OH_Fee_DEMO', 10, 2)->nullable();
            $table->decimal('Triple_Medicare_Fee_DEMO', 10, 2)->nullable();
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by')->nullable();
            $table->enum('status', ['0', '1'])->default('1')->comment('0->no, 1->yes');
            $table->enum('is_deleted', ['0', '1'])->default('0')->comment('0->no, 1->yes');
            $table->timestamps(); // creates created_at and updated_at as nullable timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cpt_code');
    }
};
