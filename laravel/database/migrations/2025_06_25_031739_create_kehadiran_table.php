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
        Schema::create('kehadiran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->references('id')->on('pegawai')->onDelete('cascade');
            $table->foreignId('aturan_kehadiran_id')->constrained()->references('id')->on('aturan_kehadiran')->onDelete('restrict');
            $table->timestamp('checked_in_at')->comment('waktu absensi');
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
        Schema::dropIfExists('kehadiran');
    }
};
