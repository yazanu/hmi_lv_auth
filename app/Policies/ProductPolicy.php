<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;

class ProductPolicy
{
    //php artisan make:policy ProductPolicy
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Product $product)
    {
        return $user->role == 'admin';
    }
}
