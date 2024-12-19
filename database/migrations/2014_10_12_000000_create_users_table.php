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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('custom_user_id');
            $table->string('name');
            $table->date('dob');
            $table->enum('s_w_d',['Son Off', 'Wife Off', 'Daughter Off']);
            $table->string('swd_name')->nullable();
            $table->string('nomination_name')->nullable();
            $table->date('nomination_dob')->nullable();
            $table->string('country_code');
            $table->string('mobile_number');
            $table->string('email')->nullable();
            $table->string('adhar_number')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_ifsc_code')->nullable();
            $table->string('bank_branch_name')->nullable();
            $table->longText('address')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('password');
            $table->integer('user_level')->default(0);
            $table->enum('device_type',['None','Ios','Android'])->nullable();
            $table->longText('device_token')->nullable();
            $table->text('refresh_token')->nullable();
            $table->integer('is_block')->default(0)->comment("0 => Not blocked, 1=> blocked");
            $table->integer('is_super_admin')->default(0)->comment("0=> Not Super Admin, 1=> SuperAdmin");
            $table->bigInteger('balance_amount')->default(0);
            $table->bigInteger('winnig_reward')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
