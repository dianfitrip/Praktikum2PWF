<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
      
        $products = Product::paginate(10);
        
        return view('product.index', compact('products'));
    }

    public function store(StoreProductRequest $request)
    {
        Gate::authorize('create', Product::class);

    
        Product::create($request->validated());

        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function create()
    {
        // Mengambil semua data kategori dari database untuk ditampilkan di dropdown
        $categories = Category::all(); 
        
        // Melempar data kategori ke halaman form tambah produk
        return view('product.create', compact('categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        return view('product.view', compact('product'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        Gate::authorize('update', $product);
        

        $product->update($request->validated());

        return redirect()->route('product.index')->with('success', 'Produk berhasil diupdate.');
    }

    public function edit(Product $product)
    {
        Gate::authorize('update', $product);

        $users = User::orderBy('name')->get();
        
        return view('product.edit', compact('product', 'users'));
    }

    public function delete($id)
    {
        Gate::authorize('delete', $product);

        $product = Product::findOrFail($id);
        
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product berhasil dihapus');
    }

    public function export()
    {
        // 1. Tentukan nama file
        $fileName = 'data_produk_' . date('Y-m-d_H-i-s') . '.csv';

        // 2. Ambil data produk beserta relasi usernya
        $products = Product::with('user')->get();

        // 3. Konfigurasi header untuk memaksa browser mengunduh file
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // 4. Proses streaming data ke dalam file CSV
        $callback = function () use ($products) {
            $file = fopen('php://output', 'w');
            
            // Tulis baris pertama sebagai Header Kolom
            fputcsv($file, ['No', 'Nama Produk', 'Kuantitas', 'Harga', 'Pemilik']);

            // Tulis data baris demi baris
            $rowNumber = 1;
            foreach ($products as $product) {
                fputcsv($file, [
                    $rowNumber++,
                    $product->name,
                    $product->qty,
                    $product->price,
                    $product->user ? $product->user->name : '-'
                ]);
            }

            fclose($file);
        };

        // 5. Kembalikan file untuk diunduh pengguna
        return response()->stream($callback, 200, $headers);
    }
}