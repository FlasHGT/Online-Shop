<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>{{ __('messages.Order Information') }}</h1>
                    <table class="table">
                        <thead>
                            <th>{{ __('messages.Order ID') }}</th>
                            <th>{{ __('messages.Address') }}</th>
                            <th>{{ __('messages.Payment Card') }}</th>
                            <th>{{ __('messages.Order Date') }}</th>
                            <th>{{ __('messages.Total Price') }}</th>
                        </thead>
                        <tbody>
                           <tr>
                                <td data-label="Order ID">{{ $order->id }}</td>
                                <td data-label="Address">
                                    <p>{{ $address->pilseta }}</p>    
                                    @if ($address->dzivokla_nr)
                                        <p>{{ $address->iela }} iela {{ $address->majas_nr }}-{{ $address->dzivokla_nr }}</p>        
                                    @else 
                                        <p>{{ $address->iela }} iela {{ $address->majas_nr }}</p>     
                                    @endif 
                                    <p>{{ $address->pasta_indekss }}</p>
                                </td>
                                <td data-label="Payment Card">
                                    <p>{{ $card->numurs }}</p>
                                </td>
                                <td data-label="Order Date">{{ $order->izpildes_datums }}</td>
                                <td data-label="Total Price">{{ number_format($order->cena, 2, ".", "") }} €</td>
                            </tr>   
                        </tbody>
                    </table>
                    
                    <h1>{{ __('messages.Order Items') }}</h1>
                    
                    <table class="table">
                        <thead>
                            <th>{{ __('messages.Picture') }}</th>
                            <th>{{ __('messages.Name') }}</th>
                            <th>{{ __('messages.Item Price') }}</th>
                            <th>{{ __('messages.Amount') }}</th>
                            <th>{{ __('messages.Total Item Price') }}</th>
                        </thead>
                        <tbody>
                            @for ($x = 0; $x < count($items); $x++)
                            <tr>
                                <td data-label="Picture"><a href="{{ url('product/' . $item_ids[$x]->prece_id) }}"><img src="{{ asset('img/test.png') }}" alt="alt"/></a></td>
                                <td data-label="Name"><a href="{{ url('product/' . $item_ids[$x]->prece_id) }}">{{ $items[$x]['nosaukums'] }}</a></td>
                                <td data-label="Item Price">  
                                    {{ number_format($items[$x]['cena'], 2, ".", "") }} €
                                </td>
                                <td data-label="Amount">{{ $item_ids[$x]->skaits }}</td>
                                <td data-label="Total Item Price">  
                                    {{ number_format($items[$x]['cena'] * $item_ids[$x]->skaits, 2, ".", "") }} €
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>