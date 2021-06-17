<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasutijums;
use App\Models\Prece;
use App\Models\Adrese;
use App\Models\KlientsKarte;
use App\Models\User;
use Illuminate\Support\Arr;
use App\Models\Kategorija;

class AdminController extends Controller
{
    public function __construct() {
        // only Admins have access to the following methods
        $this->middleware('auth.admin');
    }
    
    public function showAdminPanel () 
    {
        return view ('admin');
    }
    
    public function showOrders () 
    {
        $orders = Pasutijums::all();
        $addresses = array();
        $cards = array();
        $users = array();
        
        for ($x = 0; $x < count($orders); $x++) 
        {
            $address = Adrese::find($orders[$x]->adrese_id);
            $card = KlientsKarte::find($orders[$x]->klientakarte_id);
            $user = User::find($orders[$x]->klients_id);
            
            $addresses = Arr::add($addresses, $x, $address);
            $cards = Arr::add($cards, $x, $card);
            $users = Arr::add($users, $x, $user);
        }
        
        return view('admin', compact('orders', 'addresses', 'cards', 'users'));
    }
    
    public function showNewItem () 
    {        
        $newItem = true;
        $categories = Kategorija::all();
        
        return view('admin', compact('newItem', 'categories'));
    }
    
    public function addItem (Request $request) 
    {        
        $rules = array(
            'name' => 'required|string',
            'description' => 'required|string',
            'base_price' => 'required|numeric',
            'discount_percent' => 'nullable|numeric',
            'category' => 'required',
        );
        
        $this->validate($request, $rules);
        
        if ($request->discount_percent)
        {
            $currPrice = $request->base_price - $request->base_price * ($request->discount_percent / 100);
        }            
        else
        {
            $currPrice = $request->base_price;
        }
        
        $item = Prece::create([
            'kategorija_id' => $request->category,
            'nosaukums' => $request->name,
            'apraksts' => $request->description,
            'cena' => $currPrice,
            'sakuma_cena' => $request->base_price,
            'atlaides_procenti' => $request->discount_percent,
        ]);   
        
        return redirect()->route('main');
    }
}
