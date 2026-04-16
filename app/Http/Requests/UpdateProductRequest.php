<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'name'    => 'required|string|max:255',
        'qty'     => 'required|integer|min:0',
        'price'   => 'required|numeric|min:0',
        'user_id' => 'required|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Nama produk wajib diisi!',
            'qty.required'     => 'Kuantitas (Quantity) wajib diisi!',
            'qty.integer'      => 'Kuantitas harus berupa angka bulat.',
            'price.required'   => 'Harga produk tidak boleh kosong!',
            'price.numeric'    => 'Harga harus berupa angka.',
            'user_id.required' => 'Pemilik (Owner) wajib dipilih!',
            'user_id.exists'   => 'Pemilik yang dipilih tidak terdaftar di sistem.',
        ];
    }
}
