<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">Edit Category</h2>

                    <form action="{{ route('category.update', $category) }}" method="POST" class="space-y-4">
                        {{-- CSRF Token untuk keamanan --}}
                        @csrf
                        {{-- Method PUT wajib digunakan untuk proses update di Laravel --}}
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Category Name')" />
                            {{-- value diisi dengan old name jika gagal validasi, atau nama asli dari database --}}
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $category->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update Category') }}</x-primary-button>
                            <a href="{{ route('category.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>