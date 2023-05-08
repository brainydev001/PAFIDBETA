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
        Schema::create('communications', function (Blueprint $table) {
            $table->id();
            $table->longText('body'); 
            $table->string('type');
            $table->string('activity_name')->nullable();
            $table->string('requisition_name')->nullable();
            $table->string('pdm_name')->nullable();
            $table->string('event_name')->nullable();
            $table->longText('approval_note')->nullable();
            $table->longText('reject_note')->nullable();
            $table->string('restriction_note')->nullable();
            $table->longText('warning_note')->nullable();
            $table->boolean('was_communicated')->default(false)->nullable();
            $table->boolean('was_delivered')->default(false)->nullable();
            $table->boolean('is_pending')->default(false)->nullable();
            $table->boolean('is_canceled')->default(false)->nullable();
            $table->boolean('is_scheduled')->default(false)->nullable();
            $table->string('schedule_date')->nullable();
            $table->string('schedule_time')->nullable();
            $table->boolean('is_flagged')->default(false)->nullable();
            $table->foreignId('query_id')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('relation_user_id')->nullable();
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
        Schema::dropIfExists('communications');
    }
};
