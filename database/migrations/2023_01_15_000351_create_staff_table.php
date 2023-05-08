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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->foreignId('staff_id');
            $table->foreignId('role_id');
            $table->foreignId('approved_by');
            $table->string('approved_by_name');
            $table->foreignId('log_id')->nullable();
            $table->foreignId('created_by');
            $table->string('role_name');
            $table->string('staff_name');
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
        Schema::dropIfExists('staff');
    }
};
