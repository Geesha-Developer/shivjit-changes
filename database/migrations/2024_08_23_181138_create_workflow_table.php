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
        Schema::create('workflow', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auth_id')->nullable(); // ID of the authenticated user
            $table->string('guard_name')->nullable(); // Guard name (e.g., web, api)
            $table->string('action'); // Action performed (created, updated, deleted)
            $table->text('model_data')->nullable(); // JSON data of the model
            $table->string('model_type'); // Class name of the model
            $table->unsignedBigInteger('model_id'); // ID of the model
            $table->timestamps(); // Timestamps for log entry
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workflow');
    }
};
