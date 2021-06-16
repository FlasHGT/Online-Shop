<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasutijums;
use App\Models\Adrese;
use App\Models\KlientsKarte;
use App\Models\User;
use Illuminate\Support\Arr;

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
}
