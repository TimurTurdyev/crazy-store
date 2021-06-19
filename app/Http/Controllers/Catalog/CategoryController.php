<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category) {
        abort_if($category->status === 0, 404);
        return view('catalog.category.index', compact('category'));
    }
}
