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
        Schema::create('p_d_m_s', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('details');
            $table->integer('amount');
            $table->string('county')->nullable();
            $table->string('sub_county')->nullable();
            $table->string('area_name')->nullable();
            $table->string('region_name')->nullable();
            $table->string('note')->nullable();
            $table->boolean('is_scheduled')->default(false)->nullable();
            $table->string('schedule_date')->nullable();
            $table->string('schedule_time')->nullable();
            $table->string('start_date');
            $table->string('start_time');
            $table->string('end_date');
            $table->string('end_time');
            $table->foreignId('user_id')->nullable();
            $table->foreignId('log_id')->nullable();
            $table->foreignId('message_id')->nullable();
            $table->foreignId('reminder_id')->nullable();
            $table->foreignId('file_id')->nullable();
            $table->boolean('is_stored_locally')->default(false)->nullable();
            $table->string('storage_path')->nullable();
            $table->foreignId('rac_id')->nullable();
            $table->foreignId('staff_id')->nullable();
            $table->foreignId('managment_id')->nullable();
            $table->boolean('is_examined')->default(false)->nullable();
            $table->boolean('is_pending')->default(false)->nullable();
            $table->boolean('is_approved')->default(false)->nullable();
            $table->boolean('is_important')->default(false)->nullable();
            $table->boolean('is_disbursed')->default(false)->nullable();
            $table->boolean('is_rejected')->default(false)->nullable();
            $table->string('created_by_name')->nullable();
            $table->string('approved_by_name')->nullable();
            $table->string('rejected_by_name')->nullable();
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
        Schema::dropIfExists('p_d_m_s');
    }
};
