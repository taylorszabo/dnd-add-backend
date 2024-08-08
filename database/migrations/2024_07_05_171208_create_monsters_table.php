<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('monsters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alignment');
            $table->string('size');
            $table->string('type');
            $table->integer('cr');
            $table->string('source_book');
            $table->boolean('is_legendary');
            $table->integer('xp_amount');
            $table->integer('hit_points');
            $table->integer('initiative_modifier');
            $table->boolean('is_dead');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('monsters');
    }
};
