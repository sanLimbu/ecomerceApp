<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryShowController extends Controller
{
    
    public function __invoke(Category $category)
     {
        return view('categories.show',[
            'category' => $category
        ]);
     }
}
