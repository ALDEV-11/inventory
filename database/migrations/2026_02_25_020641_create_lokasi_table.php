<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('lokasi', function (Blueprint $table) {
            $table->increments('id_lokasi');
            $table->string('kode_rak', 20)->unique();
            $table->string('nama_lokasi', 100);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('lokasi');
    }
};