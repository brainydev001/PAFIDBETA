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
        Schema::create('calenders', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('reminder_name');
            $table->string('start_date');
            $table->string('start_time');
            $table->string('end_date');
            $table->string('end_time');
            $table->foreignId('activity_id')->nullable();
            $table->foreignId('requisition_id')->nullable();
            $table->foreignId('communication_id')->nullable();
            $table->foreignId('pdm_id')->nullable();
            $table->foreignId('county_id')->nullable();
            $table->foreignId('sub_county_id')->nullable();
            $table->foreignId('region_id')->nullable();
            $table->foreignId('area_id')->nullable();
            $table->boolean('is_shared')->default(false)->nullable();
            $table->boolean('is_scheduled')->default(false)->nullable();
            $table->string('schedule_date')->nullable();
            $table->string('schedule_time')->nullable();
            $table->boolean('to_notify')->default(false)->nullable();
            $table->string('notification_method');
            $table->boolean('reminder_delivered')->default(false)->nullable();
            $table->longText('reminder_detail');
            $table->boolean('is_stored_locally')->default(false)->nullable();
            $table->string('storage_path')->nullable();
            $table->foreignId('file_id')->nullable();
            $table->foreignId('log_id')->nullable();
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
        Schema::dropIfExists('calenders');
    }
};
