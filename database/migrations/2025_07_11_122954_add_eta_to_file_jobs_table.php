<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEtaToFileJobsTable extends Migration
{
    public function up()
    {
        Schema::table('file_jobs', function (Blueprint $table) {
            $table->timestamp('eta')->nullable()->after('end_time'); // or after any specific column
            $table->unsignedTinyInteger('no_of_retries')->default(0)->after('ETA');
        });
    }

    public function down()
    {
        Schema::table('file_jobs', function (Blueprint $table) {
            $table->dropColumn('eta');
        });
    }
}
