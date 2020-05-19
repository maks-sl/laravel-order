<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParserSingleResults extends Migration
{
    public function up()
    {
        Schema::create('parser_single_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parser_id')->references('id')->on('parser_single')->onDelete('RESTRICT');
            $table->string('value');
            $table->timestamp('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('parser_single_results');
    }
}
