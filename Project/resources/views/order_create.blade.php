<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="order-create-container p-6 bg-white border-b border-gray-200">     
                    <h1>{{ __('messages.Order Items') }}</h1>
                    <div>
                        <table class="table">
                            <thead>
                                <th>{{ __('messages.Item Name') }}</th>
                                <th>{{ __('messages.Item Price') }}</th>
                                <th>{{ __('messages.Item Count') }}</th>
                                <th>{{ __('messages.Item Total') }}</th>
                            </thead>
                            <tbody>
                                @for ($x = 0; $x < count($items); $x++)
                                    <tr item-id="{{ $items[$x]['id'] }}">
                                        <td data-label="Item Name"><a href="{{ url('product/' . $items[$x]['id']) }}">{{ $items[$x]['nosaukums'] }}</a></td>
                                        <td data-label="Item Price">
                                            {{ number_format($items[$x]['cena'], 2, ".", "") }} €
                                        </td>
                                        <td data-label="Item Count">
                                            {{ $item_qty[$x] }}
                                        </td>
                                        <td data-label="Item Total">
                                            {{ number_format($items[$x]['cena'] * $item_qty[$x], 2, ".", "") }} €
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    <h1 class="order-total">{{ __('messages.Total') }}: {{ number_format($total, 2, ".", "") }} €</h1>
                    
                    <form id="form" method="POST" action="{{action([App\Http\Controllers\OrderController::class, 'addOrder'])}}">
                        @csrf
                        <input type="hidden" name="total" id="total" value="{{ $total }}">
                        
                        <h1>{{ __('messages.Order Address') }}</h1>
                        <div id="addresses" class="order-create-item">
                            @if (!$addresses->isEmpty())
                                @foreach ($addresses as $address)
                                    <div>
                                        <div>
                                            <x-input type="radio" name="addresses" id="addresses" value="{{ $address->id }}"></x-input>
                                            <x-validation-error class="mb-4" :errors="$errors" title="addresses"/> 
                                        </div>

                                        <p><span>{{ __('messages.City') }}:</span> {{ $address->pilseta }}</p>
                                        <p><span>{{ __('messages.Street') }}:</span> {{ $address->iela }}</p>
                                        <p><span>{{ __('messages.Home number') }}:</span> {{ $address->majas_nr }}</p>

                                        @if (!$address->dzivokla_nr)
                                            <p><span>{{ __('messages.Apartment number') }}:</span> {{ __('messages.No apartment') }}</p>
                                        @else    
                                            <p><span>{{ __('messages.Apartment number') }}:</span> {{ $address->dzivokla_nr }}</p>
                                        @endif

                                        <p><span>{{ __('messages.Postcode') }}:</span> {{ $address->pasta_indekss }}</p>                                                                   
                                    </div>        
                                @endforeach
                            @else
                                <a href="{{ url('profile/address') }}"><x-button type="button">{{ __('messages.Add Address') }}</x-button></a>
                            @endif
                        </div>
                            
                        <h1>{{ __('messages.Order Payment Card') }}</h1>
                        <div id="cards" class="order-create-item">
                            @if (!$creditCards->isEmpty())     
                                @foreach ($creditCards as $card)
                                    <div>
                                        <div>
                                            <x-input type="radio" name="cards" id="cards" value="{{ $card->id }}"></x-input>
                                            <x-validation-error class="mb-4" :errors="$errors" title="cards"/> 
                                        </div>

                                        <p><span>{{ __('messages.Card number') }}:</span> {{ $card->numurs }}</p>
                                        <p><span>{{ __('messages.CVC') }}:</span> {{ $card->CVC }}</p>
                                        <p><span>{{ __('messages.Expires on') }}:</span> {{ $card->termins_lidz }}</p>
                                    </div>
                                @endforeach
                            @else
                                <a href="{{ url('profile/card') }}"><x-button type="button">{{ __('messages.Add Card') }}</x-button></a>
                            @endif
                        </div>
                    </form>
                    
                    @if ($creditCards->isEmpty() || $addresses->isEmpty())
                        <div class="order-button">
                            <p>{{ __('messages.In order to place an order, you have to have an address and a payment card!') }}</p>
                            <a href="{{ url('order/create') }}"><x-button disabled type="submit" form="form">{{ __('messages.Order') }}</x-button></a>
                        </div>
                        
                    @else
                        <div class="order-button">
                            <a href="{{ url('order/create') }}" ><x-button type="submit" form="form">{{ __('messages.Order') }}</x-button></a>
                        </div>
                    @endif
                    
                    
                </div>
            </div>
        </div>
    </div> 
</x-app-layout>

