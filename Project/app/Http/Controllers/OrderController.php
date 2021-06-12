<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Prece;
use App\Models\Adrese;
use App\Models\KlientsKarte;
use App\Models\Pasutijums;
use App\Models\PasutijumsPrece;
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
            $item_qty = session()->get('item-qty');
            
            $items = array();
            
            for ($x = 0; $x < count($sessionItems); $x++) 
            {
                $itemInfo = Prece::find($sessionItems[$x])->toArray();
                
                $items = Arr::add($items, $x, $itemInfo);
            }
            
            return view('cart', compact('items', 'item_qty'));
        }
        
        return view('cart');     
    }
    
    public function showOrder()
    {   
        if (!Auth::check())
        {
            return redirect()->url('login');
        }
        
        $addresses = Adrese::where('klients_id', Auth::id())->get();
        $creditCards = KlientsKarte::where('klients_id', Auth::id())->get();
        
        $item_qty = session()->get('item-qty');
        $sessionItems = session()->get('items');
        
        $total = 0;
        $items = array();

        for ($x = 0; $x < count($sessionItems); $x++) 
        {
            $currItem = Prece::find($sessionItems[$x]);
            
            $total += $currItem->cena * $item_qty[$x];
            
            $itemInfo = $currItem->toArray();
            
            $items = Arr::add($items, $x, $itemInfo);
        }
        
        return view('order_create', compact('addresses', 'creditCards', 'items', 'item_qty', 'total'));     
    }
    
    public function addOrder (Request $request) {
        $rules = array(
            'addresses' => 'required',
            'cards' => 'required',
        );
        
        $this->validate($request, $rules);
        
        $pasutijums = Pasutijums::create([
            'klients_id' => Auth::id(),
            'adrese_id' => $request->addresses,
            'klientakarte_id' => $request->cards,
            'izpildes_datums' => date('Y-m-d'),
            'cena' => $request->total,
        ]);   
        
        $sessionItems = session()->pull('items');
        $item_qty = session()->pull('item-qty');
        
        for ($x = 0; $x < count($sessionItems); $x++) 
        {
            PasutijumsPrece::create([
                'prece_id' => $sessionItems[$x],
                'pasutijums_id' => $pasutijums->id,
                'skaits' => $item_qty[$x],
            ]);
        }
        
        return redirect()->route('orders');
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
