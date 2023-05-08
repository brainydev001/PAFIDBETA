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
        Schema::create('farmers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number')->unique();
            $table->string('age');
            $table->string('gender');
            $table->string('type');
            $table->string('email')->nullable();
            $table->string('county')->nullable();
            $table->string('sub_county')->nullable();
            $table->foreignId('region_id')->nullable();
            $table->string('ward_name')->nullable();
            $table->foreignId('payment')->nullable();
            $table->foreignId('payment_relation_id')->nullable();
            $table->foreignId('archived_by')->nullable();
            $table->foreignId('restored_by')->nullable();
            $table->string('area_name')->nullable();
            $table->foreignId('fc_id')->nullable();
            $table->boolean('is_subscribed')->default(true);
            $table->boolean('is_disabled')->default(false);
            $table->string('disability_name')->nullable();
            $table->string('disability_note')->nullable();
            $table->string('additional_info')->nullable();
            $table->string('assessment')->nullable();
            $table->longText('note')->nullable();
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
        Schema::dropIfExists('farmers');
    }
};
