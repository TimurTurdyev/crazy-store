<?php

namespace App\Http\ViewComposers;

use App\Models\Category;
use Illuminate\View\View;

class NavigationComposer
{
    public function compose(View $view)
    {
        return $view->with('menu', Category::where('status', 1)->with('groups')->get());
    }
}
