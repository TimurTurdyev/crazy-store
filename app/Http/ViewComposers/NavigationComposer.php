<?php

namespace App\Http\ViewComposers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class NavigationComposer
{
    public function compose(View $view)
    {
        $categories = Cache::remember('categories', 60 * 60 * 24, function () {
            return Category::where('status', 1)->get();
        });
        return $view->with('menu', $categories);
    }
}
