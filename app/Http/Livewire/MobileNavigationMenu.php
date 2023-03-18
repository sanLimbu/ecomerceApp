<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class MobileNavigationMenu extends Component
{

  

    public function render()
    {
        $categories = Category::tree()->get()->toTree(); 
        return view('livewire.mobile-navigation-menu', [
            'categories' => $categories
        ]);
    }

}
