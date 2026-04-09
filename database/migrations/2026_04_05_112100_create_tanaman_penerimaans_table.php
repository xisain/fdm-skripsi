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
        Schema::create('tanaman_penerimaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penerimaan_id')->constrained()->cascadeOnDelete();
            $table->string('scientific_name');
            $table->string('nomor_akses');
            $table->string('nama_lokal');
            $table->string('marga');
            $table->string('marga_jenis');
            $table->string('suku');
            $table->string('spesies');
            $table->string('author_name');
            $table->string('locality');
            $table->string('jumlah_material');
            $table->string('vak_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanaman_penerimaans');
    }
};
