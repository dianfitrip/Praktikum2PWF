<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // foreignId: membuat kolom relasi bernama 'category_id'
            // nullable: mengizinkan data kosong (berjaga-jaga jika ada produk lama yg belum punya kategori)
            // after('user_id'): meletakkan kolom ini persis setelah kolom user_id di database
            // constrained: otomatis menyambungkan ke tabel 'categories'
            // cascadeOnDelete: jika sebuah kategori dihapus, semua produk di dalamnya ikut terhapus
            $table->foreignId('category_id')->nullable()->after('user_id')->constrained('categories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Jangan lupa tambahkan ini untuk menghapus kolom jika migrasi di-rollback
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
