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
            $table->morphs('transactionable');
            $table->string('reference');
            $table->string('merchant_ref');
            $table->integer('total_amount');
            $table->enum('status', ['paid', 'unpaid', 'expired', 'failed'])->default('unpaid');
            // $table->foreign('barang_id', 'fk1')->references('id')->on('psycholog_users');
            // $table->foreign('barang_id', 'fk2')->references('id')->on('schedules');
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
