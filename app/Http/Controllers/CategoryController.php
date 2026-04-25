<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // withCount('products') adalah fitur sakti Laravel. 
    // Fitur ini otomatis menghitung jumlah produk di tiap kategori 
    // dan menyimpannya di variabel buatan bernama 'products_count'
    $categories = Category::withCount('products')->get();
    
    // Melempar data $categories ke file view
    return view('category.index', compact('categories'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengarahkan ke file view resources/views/category/create.blade.php
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'name' => 'required|unique:categories,name|max:255',
        ]);

        // 2. Simpan ke database
        \App\Models\Category::create([
            'name' => $request->name,
        ]);

        // 3. Kembali ke halaman list dengan pesan sukses
        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Menampilkan form untuk mengedit kategori.
     */
    public function edit(Category $category)
    {
        // Mengarahkan ke file resources/views/category/edit.blade.php
        return view('category.edit', compact('category'));
    }

    /**
     * Menyimpan perubahan data kategori ke database.
     */
    public function update(Request $request, Category $category)
    {
        // Validasi: Nama wajib diisi dan unik kecuali untuk kategori ini sendiri
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
        ]);

        // Update data di database
        $category->update([
            'name' => $request->name,
        ]);

        // Kembali ke halaman list dengan pesan sukses
        return redirect()->route('category.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Menghapus kategori dari database.
     */
    public function destroy(Category $category)
    {
        // Proses hapus
        $category->delete();

        // Kembali ke halaman list dengan pesan sukses
        return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
    }
}
