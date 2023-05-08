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
        Schema::create('logs', function (Blueprint $table) { 
            $table->id();
            $table->string('origin');
            $table->string('type');
            $table->string('cluster_name');
            $table->string('unique_identifier_device')->nullable();
            $table->string('unique_identifier_imei')->nullable();
            $table->string('unique_identifier_location')->nullable();
            $table->string('unique_identifier_access')->nullable();
            $table->string('unique_identifier_ip')->nullable();
            $table->string('unique_identifier_communication')->nullable();
            $table->boolean('was_communicated_to')->default(false)->nullable();
            $table->boolean('for_access')->default(false)->nullable();
            $table->boolean('for_storage_db')->default(false)->nullable();
            $table->boolean('for_storage_local')->default(false)->nullable();
            $table->boolean('is_flagged')->default(false)->nullable();
            $table->foreignId('relation_log_id')->nullable();
            $table->foreignId('relation_user_id')->nullable();
            $table->foreignId('user_id');
            $table->longText('details');
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
        Schema::dropIfExists('logs');
    }
};
