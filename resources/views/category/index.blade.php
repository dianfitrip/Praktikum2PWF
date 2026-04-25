@foreach($categories as $category)
    <tr>
        {{-- Menampilkan nama kategori --}}
        <td>{{ $category->name }}</td>
        
        {{-- Menampilkan hasil hitungan dari withCount('products') tadi --}}
        <td>{{ $category->products_count }}</td> 
        
        <td>
            {{-- Menggunakan Component yang sudah kamu buat sebelumnya --}}
            <x-edit-button :url="route('category.edit', $category->id)" />
            <x-delete-button :url="route('category.destroy', $category->id)" />
        </td>
    </tr>
@endforeach