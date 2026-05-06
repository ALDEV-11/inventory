<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('detail_retur', function (Blueprint $table) {
            $table->increments('id_detail');
            $table->unsignedInteger('id_retur');
            $table->unsignedInteger('id_barang');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 14, 2);
            $table->decimal('subtotal', 14, 2);
            $table->timestamps();
            $table->foreign('id_retur')->references('id_retur')->on('retur_barang')->onDelete('cascade');
            $table->foreign('id_barang')->references('id_barang')->on('barang')->onDelete('cascade');
            $table->index('id_retur');
            $table->index('id_barang');
        });
    }
    public function down(): void {
        Schema::dropIfExists('detail_retur');
    }
};