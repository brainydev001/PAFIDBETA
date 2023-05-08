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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('member_name');
            $table->string('attendance_type');
            $table->string('file_path');
            $table->string('attendance_date');
            $table->foreignId('activity_id')->nullable();
            $table->foreignId('event_id')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('log_id');
            $table->foreignId('relation_id')->nullable();
            $table->foreignId('leader_id');
            $table->foreignId('confirmed_by')->nullable();
            $table->foreignId('file_id')->nullable();
            $table->foreignId('signature_id')->nullable();
            $table->boolean('is_stored_locally')->default(false)->nullable();
            $table->string('storage_path')->nullable();
            $table->longText('report');
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
        Schema::dropIfExists('attendances');
    }
};
