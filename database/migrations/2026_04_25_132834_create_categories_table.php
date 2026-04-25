<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('categories', function (Blueprint $table) {
        $table->id(); // Membuat kolom primary key (id) auto-increment
        
        // Membuat kolom 'name' bertipe string. 
        // unique() digunakan agar tidak ada 2 kategori dengan nama yang persis sama
        $table->string('name')->unique(); 
        
        $table->timestamps(); // Otomatis membuat kolom created_at dan updated_at
    });
}
};
