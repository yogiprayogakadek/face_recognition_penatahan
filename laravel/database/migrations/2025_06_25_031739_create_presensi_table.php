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
        Schema::create('presensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->references('id')->on('pegawai')->onDelete('cascade');
            $table->foreignId('aturan_presensi_id')->constrained()->references('id')->on('aturan_presensi')->onDelete('restrict');
            $table->timestamp('checked_in_at')->comment('waktu presensi');
            $table->string('tipe', 10);
            $table->boolean('is_late');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi');
    }
};
