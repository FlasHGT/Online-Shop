<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Pasutijums;
use App\Models\PasutijumsPrece;
use App\Models\Prece;
use App\Models\Adrese;
use App\Models\User;
use App\Models\KlientsKarte;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function __construct() 
    {
        // only authenticated users have access to the methods of the controller
        $this->middleware('auth');
    }
    
    public function showProfile()
    {
        $user = Auth::user();
        
        $addresses = Adrese::where('klients_id', $user->id)->get();
        $creditCards = KlientsKarte::where('klients_id', $user->id)->get();
        
        return view('profile', compact('user', 'addresses', 'creditCards'));
    }
    
    public function showProfileUpdate () 
    {
        $user = Auth::user();
        
        return view('profile_update', compact('user'));
    }
    
    public function showAddAddress () 
    {
        return view('profile_add_address');
    }
    
    public function showAddressUpdate (Request $request) 
    {
        $address = Adrese::find($request->address_id);
        
        return view('profile_update_address', compact('address'));
    }
    
    public function showCardUpdate (Request $request) 
    {
        $card = KlientsKarte::find($request->card_id);
        
        return view('profile_update_card', compact('card'));
    }
    
    public function showAddCard () 
    {
        return view('profile_add_card');
    }
    
    public function showOrders()
    {
        $orders = Pasutijums::where('klients_id', Auth::id())->get();
        $addresses = array();
        $cards = array();

        for ($x = 0; $x < count($orders); $x++) 
        {
            $address = Adrese::find($orders[$x]->adrese_id)->toArray();
            $card = KlientsKarte::find($orders[$x]->klientakarte_id)->toArray();
            
            $addresses = Arr::add($addresses, $x, $address);
            $cards = Arr::add($cards, $x, $card);
        }
        
        return view('orders', compact('orders', 'addresses', 'cards'));
    }
    
    public function showOrderItems ($id)
    {        
        $order = Pasutijums::find($id);
        
        if (Auth::id() != $order->klients_id && Auth::user()->role != 1)
        {
            return redirect()->route('main');
        }    
        
        $address = Adrese::where('id', $order->adrese_id)->first();
        $card = KlientsKarte::where('id', $order->klientakarte_id)->first();
        
        $item_ids = PasutijumsPrece::where('pasutijums_id', $order->id)->get();
        $items = array();

        for ($x = 0; $x < count($item_ids); $x++) 
        {
            $item = Prece::find($item_ids[$x]->prece_id)->toArray();
            
            $items = Arr::add($items, $x, $item);
        }
        
        return view('order', compact('order', 'address', 'card', 'items', 'item_ids'));
    }

    public function addAddress(Request $request) 
    {
        $rules = array(
            'city' => 'required|string',
            'street' => 'required|string',
            'home_number' => 'required|numeric',
            'apartment_number' => 'nullable|numeric',
            'post_code' => 'required|regex:/\b\D\D-\d{4}\b/',
        );
        
        $this->validate($request, $rules);
        
        $address = new Adrese();
        $address->klients_id = Auth::id();
        $address->pilseta = $request->city;
        $address->iela = $request->street;
        $address->majas_nr = $request->home_number;
        $address->dzivokla_nr = $request->apartment_number;
        $address->pasta_indekss = $request->post_code;
        $address->save();   
        
        return redirect()->route('profile');
    }
    
    public function addCard(Request $request) 
    {
        $rules = array(
            'number' => 'required|numeric|digits:16',
            'cvc' => 'required|numeric|max:999',
            'expiry_date' => 'required|date|after:today',
        );
        
        $this->validate($request, $rules);
        
        $card = new KlientsKarte();
        $card->klients_id = Auth::id();
        $card->numurs = $request->number;
        $card->CVC = $request->cvc;
        $card->termins_lidz = $request->expiry_date;
        $card->save();
        
        return redirect()->route('profile');
    }
    
    public function deleteAddress(Request $request) 
    {
        //Adrese::find($request->address_id)->delete();
        Adrese::where('id', $request->address_id)->update(['klients_id' => NULL]);
        // So when a user looks at an old order, they still have the information to
        // see where it was sent.
        
        return redirect()->route('profile');
    }
    
    public function deleteCard(Request $request) 
    {
        //KlientsKarte::find($request->card_id)->delete();
        KlientsKarte::where('id', $request->card_id)->update(['klients_id' => NULL]);
        // So when a user looks at an old order, they still have the information to
        // see what payment card was used.
        
        return redirect()->route('profile');
    }
    
    public function updateAddress (Request $request) 
    {       
        $rules = array(
            'city' => 'nullable|string',
            'street' => 'nullable|string',
            'home_number' => 'nullable|numeric',
            'apartment_number' => 'nullable|numeric',
            'post_code' => 'nullable|regex:/\b\D\D-\d{4}\b/',
        );
        
        $this->validate($request, $rules);
        
        $address = Adrese::where('id', $request->address_id);
        
        if ($request->city) { $address->update(['pilseta'=>$request->city]); }
        
        if ($request->street) { $address->update(['iela'=>Hash::make($request->street)]); }
        
        if ($request->home_number) { $address->update(['majas_nr'=>$request->home_number]); }
        
        if ($request->post_code) { $address->update(['pasta_indekss'=>$request->post_code]); }
        
        $address->update(['dzivokla_nr'=>$request->apartment_number]);       
        
        return redirect()->route('profile');
    }
    
    public function updateCard (Request $request) 
    {
        $rules = array(
            'number' => 'nullable|numeric|digits:16',
            'cvc' => 'nullable|numeric|max:999',
            'expiry_date' => 'nullable|date|after:today',
        );
        
        $this->validate($request, $rules);
        
        $card = KlientsKarte::where('id', $request->card_id);

        if ($request->number) { $card->update(['numurs'=>$request->number]); }
        
        if ($request->cvc) { $card->update(['CVC'=>$request->cvc]); }
        
        if ($request->expiry_date != KlientsKarte::find($request->card_id)->termins_lidz) { $card->update(['termins_lidz'=>$request->expiry_date]); }   
        
        return redirect()->route('profile');
    }
    
    public function profileInfoUpdate (Request $request) 
    {       
        $rules = array(
            'email' => 'nullable|email|unique:users,email',
            'password' => ['nullable', 'confirmed', Rules\Password::min(8)],
            'name' => 'nullable|string|required_with:surname',
            'surname' => 'nullable|string|required_with:name',
            'birthday' => 'nullable|date',
            'mobile_phone' => 'nullable|numeric|min:20000000|max:29999999',
        );
        
        $this->validate($request, $rules);
        
        $user = User::where('id', Auth::id());
        
        if ($request->email) { $user->update(['email'=>$request->email]); }
        
        if ($request->password) { $user->update(['password'=>Hash::make($request->password)]); }
        
        if ($request->name) { $user->update(['vards'=>$request->name]); }
        
        if ($request->surname) { $user->update(['uzvards'=>$request->surname]); }
        
        $user->update(['dzimsanas_diena'=>$request->birthday]);       
        $user->update(['telefona_nr'=>$request->mobile_phone]);
           
        return redirect()->route('profile');
    }
}
