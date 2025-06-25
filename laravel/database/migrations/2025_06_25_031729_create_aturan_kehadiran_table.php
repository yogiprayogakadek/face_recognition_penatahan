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
        Schema::create('aturan_kehadiran', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['masuk', 'pulang']);
            $table->time('start_time');
            $table->time('end_time');
            $table->time('late_after')->nullable()->comment('waktu yang dianggap telat');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aturan_kehadiran');
    }
};
