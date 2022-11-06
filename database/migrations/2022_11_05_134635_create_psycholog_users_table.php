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
        Schema::create('psycholog_users', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('psycholog_id')->constrained('psychologs');
            $table->foreignId('user_id')->constrained('users');
            $table->double('nilai');
            $table->enum('status', ['lunas', 'belum lunas'])->default('belum lunas');
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
        Schema::dropIfExists('psycholog_users');
    }
};
