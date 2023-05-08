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
        Schema::create('proofs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('amount');
            $table->string('file_path');
            $table->string('payment_date');
            $table->longText('details');
            $table->longText('report');
            $table->string('category')->nullable();
            $table->string('sub_category')->nullable();
            $table->string('scheduled_start_date')->nullable();
            $table->string('scheduled_end_date')->nullable();
            $table->string('scheduled_start_time')->nullable();
            $table->string('scheduled_end_timem')->nullable();
            $table->foreignId('activity_id')->nullable();
            $table->foreignId('requisition_id')->nullable();
            $table->foreignId('pdm_id')->nullable();
            $table->foreignId('expense_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('relation_id')->nullable();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('disbursed_by')->nullable();
            $table->foreignId('rejected_by')->nullable();
            $table->foreignId('confirmed_by')->nullable(); 
            $table->foreignId('file_id')->nullable();
            $table->boolean('is_stored_locally')->default(false)->nullable();
            $table->string('storage_path')->nullable();
            $table->boolean('is_ongoing')->default(false)->nullable();
            $table->boolean('is_audited')->default(false)->nullable();
            $table->boolean('is_pending')->default(false)->nullable();
            $table->boolean('is_verified')->default(false)->nullable();
            $table->boolean('is_communicated')->default(false)->nullable();
            $table->string('created_by_name')->nullable();
            $table->string('approved_by_name')->nullable();
            $table->string('audited_by_name')->nullable();
            $table->string('verified_by_name')->nullable();
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
        Schema::dropIfExists('proofs');
    }
};
