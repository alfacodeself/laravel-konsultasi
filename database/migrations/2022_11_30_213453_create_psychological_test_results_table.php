<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psychological_test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('psycholog_id')->constrained('psychologs');
            $table->uuid()->unique();
            $table->integer('poin_minimum');
            $table->integer('poin_maksimum');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('psychological_test_results');
    }
};
