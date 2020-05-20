<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedParserSinglePeriod extends Migration
{
    public function up()
    {
        Schema::table('parser_single', function (Blueprint $table) {
            $table->integer('period');
        });

        DB::table('parser_single')->update([
            'period' => 10,
        ]);
    }

    public function down()
    {
        Schema::table('parser_single', function (Blueprint $table) {
            $table->dropColumn('period');
        });
    }
}
