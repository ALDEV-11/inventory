<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->increments('id_masuk');
            $table->unsignedInteger('id_supplier');
            $table->unsignedBigInteger('id_user');
            $table->string('nomor_po', 20);
            $table->date('tanggal');
            $table->enum('status', ['draft', 'disetujui', 'ditolak']);
            $table->decimal('total_nilai', 14, 2);
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->foreign('id_supplier')->references('id_supplier')->on('supplier')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('user')->onDelete('set null');
            $table->index('id_supplier');
            $table->index('id_user');
        });
    }
    public function down(): void {
        Schema::dropIfExists('barang_masuk');
    }
};