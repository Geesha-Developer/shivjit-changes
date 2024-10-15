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
        Schema::table('teamlead', function (Blueprint $table) {
            $table->string('office')->nullable(); // Add the 'office' column as a string and make it nullable
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teamlead', function (Blueprint $table) {
            $table->dropColumn('office'); // Drop the 'office' column if rolling back
        });
    }
};
