<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prece;
use App\Models\Kategorija;

class ItemController extends Controller
{
    public function showMain(Request $request)
    {
        $selectedCategory = NULL;
        $categories = Kategorija::all();
        $items = Prece::where('id', '>', 0);
        
        if ($request->search)
        {
            $items = Prece::where('nosaukums', 'LIKE', '%'.$request->search.'%'); 
        }
        else
        {
            if ($request->category) 
            {
                $selectedCategory = $request->category; 
                $items = Prece::where('kategorija_id', $selectedCategory);
            } 
        }      
        
        sortItems($items, $request->sort);
        
        $items = $items->paginate(15);
        
        checkItemsInCart($items); // Custom helper function, check app/helpers.php   
        
        return view('main', compact('items', 'categories', 'selectedCategory'));
    }
    
    public function showProduct($id)
    {
        $item = Prece::find($id);
        
        $item->push('inCart');
        $item->inCart = 0;
        
        if (session()->has('items') && in_array($item->id, session()->get('items'))) 
        {
            $item->inCart = 1;
        }
        
        return view('product', compact('item'));
    }
}
