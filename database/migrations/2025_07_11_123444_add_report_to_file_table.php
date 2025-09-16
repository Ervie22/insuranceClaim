<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReportToFileTable extends Migration
{
    public function up()
    {
        Schema::table('file', function (Blueprint $table) {
            $table->string('report', 4096)->nullable()->after('result_url'); // or after another column
        });
    }

    public function down()
    {
        Schema::table('file', function (Blueprint $table) {
            $table->dropColumn('report');
        });
    }
}
