<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Category;
use App\Models\Provider;
use Illuminate\Support\Facades\Cache;

class ProviderService
{
    public function getCategories()
    {
        return Cache::rememberForever('categories_list', function () {
            return Category::select('id', 'name')->get();
        });
    }

    public function getProvidersByCategory(string $categoryName = 'all')
    {
        return Cache::remember('providers_category_'.$categoryName, 3600, function () use ($categoryName) {
            $query = Provider::with('category');

            if ($categoryName !== 'all') {
                $query->whereHas('category', function ($q) use ($categoryName): void {
                    $q->where('name', $categoryName);
                });
            }

            return $query->get();
        });
    }
}
