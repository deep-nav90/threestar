<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('credit_user_id')->unsigned();
            $table->foreign('credit_user_id')->references('id')->on('users')->onDeleted('cascade');
            $table->bigInteger('upline_id')->unsigned()->nullable();
            $table->foreign('upline_id')->references('id')->on('users')->onDeleted('cascade');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDeleted('cascade');
            $table->double('percentage')->default(0);
            $table->bigInteger('total_amount');
            $table->bigInteger('credit_user_amount');
            $table->enum('type_of_credit',['By Tree','By Sponser', 'By Debit']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
