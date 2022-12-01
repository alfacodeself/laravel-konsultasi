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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('id')->on('psycholog_users');
            $table->string('reference');
            $table->string('merchant_ref');
            $table->integer('total_amount');
            $table->enum('type', ['konseling', 'psikolog']);
            $table->enum('status', ['paid', 'unpaid', 'expired', 'failed'])->default('unpaid');
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
        Schema::dropIfExists('transactions');
    }
};
