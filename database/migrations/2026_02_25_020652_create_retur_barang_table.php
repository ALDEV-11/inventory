<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('retur_barang', function (Blueprint $table) {
            $table->increments('id_retur');
            $table->unsignedBigInteger('id_user');
            $table->string('nomor_retur', 20);
            $table->string('jenis', 100);
            $table->date('tanggal');
            $table->text('alasan')->nullable();
            $table->decimal('total_nilai', 14, 2);
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
            $table->index('id_user');
        });
    }
    public function down(): void {
        Schema::dropIfExists('retur_barang');
    }
};