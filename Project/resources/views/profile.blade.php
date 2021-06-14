<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class='profile'>
                        <h1>{{ __("messages.User Information") }}</h1>
                        <div class='profile-item'>
                            <p><span>{{ __("messages.Email") }}:</span> {{ $user->email }}</p>
                            <p><span>{{ __("messages.Password") }}:</span> *****</p>

                            @if (!$user->vards)
                                <p><span>{{ __("messages.Name") }}:</span> {{ __("messages.You haven't added your name") }}</p>
                            @else
                                <p><span>{{ __("messages.Name") }}:</span> {{ $user->vards }}</p>
                            @endif
                            
                            @if (!$user->uzvards)
                                <p><span>{{ __("messages.Surname") }}:</span> {{ __("messages.You haven't added your surname") }}</p>
                            @else
                                <p><span>{{ __("messages.Surname") }}:</span> {{ $user->uzvards }}</p>
                            @endif
                            
                            @if (!$user->dzimsanas_diena)
                                <p><span>{{ __("messages.Birthday") }}:</span> {{ __("messages.You haven't added your birthday") }}</p>
                            @else
                                <p><span>{{ __("messages.Birthday") }}:</span> {{ $user->dzimsanas_diena }}</p>
                            @endif

                            @if (!$user->telefona_nr)
                                <p><span>{{ __("messages.Phone Number") }}:</span> {{ __("messages.You haven't added your phone number") }}</p>
                            @else
                                <p><span>{{ __("messages.Phone Number") }}:</span> {{ $user->telefona_nr }}</p>
                            @endif            
                            
                            <a href="{{ url('profile/update') }}"><x-button type="button">{{ __("messages.Update") }}</x-button></a>
                        </div>
                        
                        <h1>{{ __("messages.Addresses") }}</h1>                       
                        <div class='profile-item'>
                            <div class='profile-item-child'>
                                @if (!$addresses->isEmpty())
                                    @foreach ($addresses as $address)
                                        <div class='profile-item-child-div'>
                                            <p><span>{{ __("messages.City") }}:</span> {{ $address->pilseta }}</p>
                                            <p><span>{{ __("messages.Street") }}:</span> {{ $address->iela }}</p>
                                            <p><span>{{ __("messages.Home number") }}:</span> {{ $address->majas_nr }}</p>
                                            @if (!$address->dzivokla_nr)
                                                <p><span>{{ __("messages.Apartment number") }}:</span> {{ __("messages.No apartment") }}</p>
                                            @else    
                                                <p><span>{{ __("messages.Apartment number") }}:</span> {{ $address->dzivokla_nr }}</p>
                                            @endif
                                            <p><span>{{ __("messages.Postcode") }}:</span> {{ $address->pasta_indekss }}</p>                                                                   
                                            
                                            <form class="sub-form-btn" method="GET" action="{{ action([App\Http\Controllers\UserController::class, 'showAddressUpdate']) }}">
                                                @csrf
                                                <input type="hidden" name="address_id" value="{{ $address->id }}"/>
                                                <x-button type="submit">{{ __("messages.Update") }}</x-button>
                                            </form>
                                            
                                            <form class="sub-form-btn" method="POST" action="{{ action([App\Http\Controllers\UserController::class, 'deleteAddress']) }}">
                                                @csrf @method('DELETE')
                                                <input type="hidden" name="address_id" value="{{ $address->id }}"/>
                                                <x-button type="submit">{{ __("messages.Remove") }}</x-button>
                                            </form>
                                        </div>        
                                    @endforeach
                                @else
                                    <p>{{ __("messages.You haven't added any addresses") }}</p>
                                @endif
                            </div>
                        </div>
                        <a href="{{ url('profile/address') }}"><x-button class='profile-add-button' type="button">{{ __("messages.Add Address") }}</x-button></a>
                        
                        <h1>{{ __("messages.Payment Cards") }}</h1>
                        <div class='profile-item'>
                            <div class='profile-item-child'>
                                @if (!$creditCards->isEmpty())
                                    @foreach ($creditCards as $card)
                                        <div class='profile-item-child-div'>
                                            <p><span>{{ __("messages.Card number") }}:</span> {{ $card->numurs }}</p>
                                            <p><span>{{ __("messages.CVC") }}:</span> {{ $card->CVC }}</p>
                                            <p><span>{{ __("messages.Expires on") }}:</span> {{ $card->termins_lidz }}</p>
                                            
                                            <form class="sub-form-btn" method="GET" action="{{ action([App\Http\Controllers\UserController::class, 'showCardUpdate']) }}">
                                                @csrf
                                                <input type="hidden" name="card_id" value="{{ $card->id }}"/>
                                                <x-button type="submit">{{ __("messages.Update") }}</x-button>
                                            </form>
                                            
                                            <form class="sub-form-btn" method="POST" action="{{ action([App\Http\Controllers\UserController::class, 'deleteCard']) }}">
                                                @csrf @method('DELETE')
                                                <input type="hidden" name="card_id" value="{{ $card->id }}"/>
                                                <x-button type="submit">{{ __("messages.Remove") }}</x-button>
                                            </form>
                                        </div>
                                    @endforeach
                                @else
                                    <p>{{ __("messages.You haven't added any payment cards") }}</p>
                                @endif
                            </div>
                        </div>                    
                        <a href="{{ url('profile/card') }}"><x-button class='profile-add-button' type="button">{{ __("messages.Add Card") }}</x-button></a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>