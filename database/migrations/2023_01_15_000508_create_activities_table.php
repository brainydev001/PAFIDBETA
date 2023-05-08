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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->longText('details');
            $table->string('start_date');
            $table->string('start_time');
            $table->string('end_date');
            $table->string('end_time');
            $table->string('county')->nullable();
            $table->string('sub_county')->nullable();
            $table->string('area_name')->nullable();
            $table->string('activity_note')->nullable();
            $table->foreignId('region_id')->nullable();
            $table->foreignId('area_id')->nullable();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('facilitator_id')->nullable();
            $table->foreignId('requisition_id')->nullable();
            $table->foreignId('pdm_id')->nullable();
            $table->string('event_id')->nullable();
            $table->foreignId('relation_id')->nullable();
            $table->string('relation_name')->nullable();
            $table->boolean('is_stored_locally')->default(false)->nullable();
            $table->foreignId('file_id')->nullable();
            $table->foreignId('signature_id')->nullable();
            $table->foreignId('log_id')->nullable();
            $table->boolean('is_examined')->default(false)->nullable();
            $table->boolean('is_pending')->default(false)->nullable();
            $table->boolean('is_approved')->default(false)->nullable();
            $table->boolean('is_important')->default(false)->nullable();
            $table->boolean('is_postponed')->default(false)->nullable();
            $table->boolean('is_canceled')->default(false)->nullable();
            $table->boolean('is_scheduled')->default(false)->nullable();
            $table->string('schedule_date')->nullable();
            $table->string('schedule_time')->nullable();
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
        Schema::dropIfExists('activities');
    }
};
