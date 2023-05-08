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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('amount');
            $table->longText('details');
            $table->string('category')->nullable();
            $table->string('sub_category')->nullable();
            $table->foreignId('activity_id')->nullable();
            $table->foreignId('requisition_id')->nullable();
            $table->foreignId('pdm_id')->nullable();
            $table->string('event_name')->nullable();
            $table->foreignId('relation_id')->nullable();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('disbursed_by')->nullable();
            $table->foreignId('rejected_by')->nullable();
            $table->foreignId('confirmed_by')->nullable();
            $table->boolean('is_stored_locally')->default(false)->nullable();
            $table->boolean('is_audited')->default(false)->nullable();
            $table->boolean('is_pending')->default(false)->nullable();
            $table->boolean('has_proof')->default(false)->nullable();
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
        Schema::dropIfExists('budgets');
    }
};
