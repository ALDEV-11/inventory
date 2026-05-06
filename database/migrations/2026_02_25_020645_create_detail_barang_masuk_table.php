<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('detail_barang_masuk', function (Blueprint $table) {
            $table->increments('id_detail');
            $table->unsignedInteger('id_masuk');
            $table->unsignedInteger('id_barang');
            $table->unsignedInteger('id_lokasi');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 14, 2);
            $table->decimal('subtotal', 14, 2);
            $table->timestamps();
            $table->foreign('id_masuk')->references('id_masuk')->on('barang_masuk')->onDelete('cascade');
            $table->foreign('id_barang')->references('id_barang')->on('barang')->onDelete('cascade');
            $table->foreign('id_lokasi')->references('id_lokasi')->on('lokasi')->onDelete('cascade');
            $table->index('id_masuk');
            $table->index('id_barang');
            $table->index('id_lokasi');
        });
    }
    public function down(): void {
        Schema::dropIfExists('detail_barang_masuk');
    }
};