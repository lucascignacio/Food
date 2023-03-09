<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
        /**
     * Handle the Plan "creating" event.
     */
    public function creating(Category $category)
    {
        $category->url = Str::kebab($category->name);
        $category->uuid = Str::uuid();
    }

    /**
     * Handle the Plan "updating" event.
     */
    public function updating(Category $category)
    {
        $category->url = Str::kebab($category->name);
    }
}
