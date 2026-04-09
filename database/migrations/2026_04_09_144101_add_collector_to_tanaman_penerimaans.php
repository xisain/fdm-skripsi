<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tanaman_penerimaans', function (Blueprint $table) {
            $table->foreignId('collector_id')->references('id')->on('collectors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tanaman_penerimaans', function (Blueprint $table) {
            //
        });
    }
};
