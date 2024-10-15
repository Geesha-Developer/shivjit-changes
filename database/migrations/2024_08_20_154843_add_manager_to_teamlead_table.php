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
            $table->boolean('manager')->default(false); // Adding a boolean column with a default value of false
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
            $table->dropColumn('manager'); // Removing the column if the migration is rolled back
        });
    }
};
