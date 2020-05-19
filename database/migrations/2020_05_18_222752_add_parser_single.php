<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParserSingle extends Migration
{

    public function up()
    {
        Schema::create('parser_single', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users')->onDelete('RESTRICT');
            $table->string('name');
            $table->string('status', 16);
            $table->string('url');
            $table->string('css_path');
            $table->string('regex')->nullable();
            $table->string('match_group')->nullable();
            $table->boolean('strip_tags')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parser_single');
    }
}
