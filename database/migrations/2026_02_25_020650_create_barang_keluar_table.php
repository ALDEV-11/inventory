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
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->increments('id_keluar');
            $table->unsignedBigInteger('id_user');
            $table->string('nomor_keluar', 20);
            $table->date('tanggal');
            $table->string('tujuan', 200);
            $table->text('keterangan')->nullable();
            $table->decimal('total_nilai', 14, 2);
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
            $table->index('id_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluar');
    }
};
