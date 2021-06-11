<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class='profile'>
                        <h1>User Information</h1>
                        <div class='profile-item'>
                            <p><span>Email:</span> {{ $user->email }}</p>
                            <p><span>Password:</span> *****</p>
                            <p><span>Name:</span> {{ $user->vards }}</p>
                            <p><span>Surname:</span> {{ $user->uzvards }}</p>

                            @if (!$user->dzimsanas_diena)
                                <p><span>Birthday:</span> You haven't added your birthday</p>
                            @else
                                <p><span>Birthday:</span> {{ $user->dzimsanas_diena }}</p>
                            @endif

                            @if (!$user->telefona_nr)
                                <p><span>Phone Number:</span> You haven't added your phone number</p>
                            @else
                                <p><span>Phone Number:</span> {{ $user->telefona_nr }}</p>
                            @endif            
                            
                            <a href="{{ url('profile/update') }}"><x-button type="button">Update</x-button></a>
                        </div>
                        
                        <h1>Addresses</h1>                       
                        <div class='profile-item'>
                            <div class='profile-item-child'>
                                @if (!$addresses->isEmpty())
                                    @foreach ($addresses as $address)
                                        <div class='profile-item-child-div'>
                                            <p><span>City:</span> {{ $address->pilseta }}</p>
                                            <p><span>Street:</span> {{ $address->iela }}</p>
                                            <p><span>Home number:</span> {{ $address->majas_nr }}</p>
                                            @if (!$address->dzivokla_nr)
                                                <p><span>Apartment number:</span> No apartment</p>
                                            @else    
                                                <p><span>Apartment number:</span> {{ $address->dzivokla_nr }}</p>
                                            @endif
                                            <p><span>Postcode:</span> {{ $address->pasta_indekss }}</p>                                                                   
                                            
                                            <form class="sub-form-btn" method="GET" action="{{ action([App\Http\Controllers\UserController::class, 'showAddressUpdate']) }}">
                                                @csrf
                                                <input type="hidden" name="address_id" value="{{ $address->id }}"/>
                                                <x-button type="submit">Update</x-button>
                                            </form>
                                            
                                            <form class="sub-form-btn" method="POST" action="{{ action([App\Http\Controllers\UserController::class, 'deleteAddress']) }}">
                                                @csrf @method('DELETE')
                                                <input type="hidden" name="address_id" value="{{ $address->id }}"/>
                                                <x-button type="submit">Remove</x-button>
                                            </form>
                                        </div>        
                                    @endforeach
                                @else
                                    <p>You haven't added any addresses</p>
                                @endif
                            </div>
                        </div>
                        <a href="{{ url('profile/address') }}"><x-button class='profile-add-button' type="button">Add Address</x-button></a>
                        
                        <h1>Payment Cards</h1>
                        <div class='profile-item'>
                            <div class='profile-item-child'>
                                @if (!$creditCards->isEmpty())
                                    @foreach ($creditCards as $card)
                                        <div class='profile-item-child-div'>
                                            <p><span>Card number:</span> {{ $card->numurs }}</p>
                                            <p><span>CVC:</span> {{ $card->CVC }}</p>
                                            <p><span>Expires on:</span> {{ $card->termins_lidz }}</p>
                                            
                                            <form class="sub-form-btn" method="GET" action="{{ action([App\Http\Controllers\UserController::class, 'showCardUpdate']) }}">
                                                @csrf
                                                <input type="hidden" name="card_id" value="{{ $card->id }}"/>
                                                <x-button type="submit">Update</x-button>
                                            </form>
                                            
                                            <form class="sub-form-btn" method="POST" action="{{ action([App\Http\Controllers\UserController::class, 'deleteCard']) }}">
                                                @csrf @method('DELETE')
                                                <input type="hidden" name="card_id" value="{{ $card->id }}"/>
                                                <x-button type="submit">Remove</x-button>
                                            </form>
                                        </div>
                                    @endforeach
                                @else
                                    <p>You haven't added any payment cards</p>
                                @endif
                            </div>
                        </div>                    
                        <a href="{{ url('profile/card') }}"><x-button class='profile-add-button' type="button">Add Card</x-button></a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>