<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('supplier', function (Blueprint $table) {
            $table->increments('id_supplier');
            $table->string('kode_supplier', 20)->unique();
            $table->string('nama_supplier', 100);
            $table->text('alamat');
            $table->string('no_telp', 15);
            $table->string('email', 100);
            $table->string('pic', 100);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('supplier');
    }
};