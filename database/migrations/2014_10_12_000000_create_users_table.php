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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); 
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('age');
            $table->string('gender');
            $table->string('email')->nullable();
            $table->string('county')->nullable();
            $table->string('sub_county')->nullable();
            $table->foreignId('region_id')->nullable();
            $table->string('ward_name')->nullable();
            $table->string('photo')->nullable();
            $table->foreignId('staff_id');
            $table->foreignId('role_id');
            $table->timestamp('last_seen')->nullable();
            $table->string('password');
            $table->foreignId('created_by')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->string('approved_by_name')->nullable();
            $table->foreignId('approved_by')->nullable();
            $table->boolean('in_attendance')->default(false);
            $table->boolean('is_flagged')->default(false);
            $table->foreignId('file_id');
            $table->string('log_id')->nullable();
            $table->boolean('otp_created')->default(false);
            $table->boolean('otp_delivered')->default(false);
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
