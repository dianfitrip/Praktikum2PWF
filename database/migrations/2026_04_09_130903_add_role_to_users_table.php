<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        // Ini akan menambahkan kolom 'role' setelah kolom 'email'
        // Secara otomatis, semua orang yang mendaftar akan menjadi 'user' biasa
        $table->string('role')->default('user')->after('email'); 
    });
}
public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('role'); // Ini untuk menghapus kolom jika migrasi dibatalkan
    });
}
};
