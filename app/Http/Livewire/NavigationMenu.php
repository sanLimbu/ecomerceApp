<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
class NavigationMenu extends Component
{

    public $showDiv = false;
    public function render()
    {  
        $categories = Category::tree()->get()->toTree(); 

        return view('livewire.navigation-menu', [
            'categories' => $categories
        ]);
    }

    public function hideDiv() {
        $this->showDiv = false;
        return view('livewire.navigation-menu');
    }
}
