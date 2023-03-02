<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductObserver
{
         /**
     * Handle the Product "creating" event.
     */
    public function creating(Product $product)
    {
        $product->uuid = Str::uuid();
        $product->flag = Str::kebab($product->title);
    }

    /**
     * Handle the Product "updating" event.
     */
    public function updating(Product $product)
    {
        $product->flag = Str::kebab($product->title);
    }
}
