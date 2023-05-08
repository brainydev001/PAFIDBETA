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
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('details');
            $table->longText('note');
            $table->foreignId('item_id');
            $table->foreignId('created_by');
            $table->foreignId('archived_by');
            $table->foreignId('restored_by');
            $table->foreignId('file_id');
            $table->boolean('is_stored_locally')->default(false)->nullable();
            $table->string('storage_path')->nullable();
            $table->boolean('is_restored')->default(false)->nullable();
            $table->boolean('fk_deleted')->default(false)->nullable();
            $table->boolean('check')->default(false)->nullable();
            $table->string('file_path')->nullable();
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
        Schema::dropIfExists('archives');
    }
};
