<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): bool
    {
        return true;
    }

   public function create(User $user): bool
    {
        // Gunakan strtolower untuk menghindari error perbedaan huruf besar/kecil
        return strtolower($user->role) === 'admin' || strtolower($user->role) === 'staff';
    }

    public function update(User $user, Product $product): bool
    {
        // Harus Admin DAN ID user harus sama dengan ID pembuat produk
        return $user->isAdmin() && $user->id === $product->user_id;
    }

    public function delete(User $user, Product $product): bool
    {
        // Izinkan jika user adalah pemilik produk ATAU user adalah admin
        return $user->id === $product->user_id || strtolower($user->role) === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        return false;
    }
}
