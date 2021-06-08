<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prece;
use Illuminate\Support\Arr;

class OrderController extends Controller
{    
    public function addOrRemoveFromCart(Request $request) 
    {      
        if (session()->has('items') && in_array($request->id, session()->get('items'))) { 
        // check if there is an array named items in session and then check if a given id is in the array
            $items = session()->pull('items'); // we retrieve the array and then delete it
            $item_qty = session()->pull('item-qty'); 
            
            $index = array_search($request->id, $items); //search for the id in the array
            
            unset($items[$index]); // delete the value in that index
            unset($item_qty[$index]);
            
            $item_qty = array_values($item_qty);
            $items = array_values($items);
            
            session()->put('items', $items); // insert the array back in session without the deleted id
            session()->put('item-qty', $item_qty);
        }        
        else {
            session()->push('items', $request->id); // add item to cart
            session()->push('item-qty', 1);
        }
    }   
    
    public function showCart()
    {
        if (session()->has('items'))
        {
            $sessionItems = session()->get('items');
            $items = array();
            
            for ($x = 0; $x < count($sessionItems); $x++) 
            {
                $itemInfo = Prece::find($sessionItems[$x])->toArray();
            
                $items = Arr::add($items, $x, $itemInfo);
            }
            
            $item_qty = session()->get('item-qty');
            
            return view('cart', compact('items', 'item_qty'));
        }
        
        return view('cart');     
    }
    
    public function changeQuantity (Request $request) 
    {
        $items = session()->get('items');
        $item_qty = session()->pull('item-qty'); 

        $index = array_search($request->id, $items);

        if (!$request->increase)
        {
            if ($item_qty[$index] != 1)
            {
                $item_qty[$index]--;    
            }
        }
        else
        {
            $item_qty[$index]++;   
        }

        session()->put('item-qty', $item_qty);
    }
}
