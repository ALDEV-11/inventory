<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('barang', function (Blueprint $table) {
            $table->increments('id_barang');
            $table->unsignedInteger('id_kategori');
            $table->string('kode_barang', 20)->unique();
            $table->string('nama_barang', 100);
            $table->text('satuan');
            $table->decimal('harga_beli', 14, 2);
            $table->decimal('harga_jual', 14, 2);
            $table->integer('stok_min');
            $table->integer('stok_saat_ini');
            $table->string('gambar', 255)->nullable();
            $table->timestamps();
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_barang')->onDelete('cascade');
            $table->index('id_kategori');
        });
    }
    public function down(): void {
        Schema::dropIfExists('barang');
    }
};