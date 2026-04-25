<?php

// Mendefinisikan namespace agar class ini terorganisasi sesuai struktur folder Laravel
namespace App\View\Components;

// Mengimpor class-class dari framework yang dibutuhkan untuk menjalankan komponen ini
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

// Mendeklarasikan class AddProduct yang mewarisi (extends) fitur dari class Component bawaan Laravel
class AddProduct extends Component
{
    // Mendeklarasikan properti publik.
    // Karena bersifat public, variabel $url dan $name ini nantinya otomatis bisa diakses langsung di dalam file tampilan (blade).
    public string $url;
    public string $name;

    /**
     * Create a new component instance.
     * * Method konstruktor ini dijalankan secara otomatis saat komponen dipanggil.
     * Ia menangkap atribut yang dikirimkan melalui tag HTML komponen 
     * (Contoh penggunaannya di blade: <x-add-product url="/link" name="Produk A" />)
     */
    public function __construct(string $url, string $name)
    {
        // Menyimpan nilai dari parameter ke dalam properti milik class ini
        $this->url = $url;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     * * Method ini menentukan file tampilan (view) mana yang akan dirender (ditampilkan) oleh komponen ini.
     * Tipe kembaliannya bisa berupa View, Closure, atau string.
     */
    public function render(): View|Closure|string
    {
        // Memuat dan mengembalikan file view yang lokasinya ada di:
        // resources/views/components/add-product.blade.php
        return view('components.add-product');
    }
}