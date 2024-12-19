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
        Schema::create('under_take_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sponser_id')->unsigned();
            $table->foreign('sponser_id')->references('id')->on('users')->onDeleted('cascade');
            $table->bigInteger('upline_id')->unsigned();
            $table->foreign('upline_id')->references('id')->on('users')->onDeleted('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDeleted('cascade');
            $table->longText('sequece_wise_user_added_record_ids')->nullable();
            $table->bigInteger('amount')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('under_take_users');
    }
};
