<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Header & Tombol Add --}}
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold">Category List</h2>
                            <p class="text-sm text-gray-500">Manage your category</p>
                        </div>
                        <a href="{{ route('category.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                            + Add Category
                        </a>
                    </div>

                    {{-- Tabel Category --}}
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left font-semibold uppercase">Name</th>
                                    <th class="px-6 py-3 text-left font-semibold uppercase">Total Product</th>
                                    <th class="px-6 py-3 text-center font-semibold uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($categories as $category)
                                    <tr>
                                        <td class="px-6 py-4">{{ $category->name }}</td>
                                        <td class="px-6 py-4">{{ $category->products_count }}</td> 
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center gap-2">
                                                <x-edit-button :url="route('category.edit', $category->id)" />
                                                <x-delete-button :url="route('category.destroy', $category->id)" />
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                                            Belum ada kategori.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>