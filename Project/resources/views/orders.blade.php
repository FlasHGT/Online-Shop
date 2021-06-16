<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>{{ __('messages.Orders') }}</h1>
                    
                    @if (!$orders->isEmpty())
                        <table class="table">
                            <thead>
                                <th>{{ __('messages.Order ID') }}</th>
                                <th>{{ __('messages.Address') }}</th>
                                <th>{{ __('messages.Payment Card') }}</th>
                                <th>{{ __('messages.Order Date') }}</th>
                                <th>{{ __('messages.Total Price') }}</th>
                                <th>{{ __('messages.Items') }}</th>
                                <th>{{ __('messages.Invoice') }}</th>
                            </thead>
                            <tbody>
                                @for ($x = 0; $x < count($orders); $x++) 
                                    <tr>
                                        <td data-label="Order ID">{{ $orders[$x]->id }}</td>
                                        <td data-label="Address">
                                            <p>{{ $addresses[$x]['pilseta'] }}</p>    
                                            @if ($addresses[$x]['dzivokla_nr'])
                                                <p>{{ $addresses[$x]['iela'] }} {{ __('messages.Street') }} {{ $addresses[$x]['majas_nr'] }}-{{ $addresses[$x]['dzivokla_nr'] }}</p>        
                                            @else 
                                                <p>{{ $addresses[$x]['iela'] }} {{ __('messages.Street') }} {{ $addresses[$x]['majas_nr'] }}</p>     
                                            @endif 
                                            <p>{{ $addresses[$x]['pasta_indekss'] }}</p>
                                        </td>
                                        <td data-label="Payment Card">
                                            <p>{{ $cards[$x]['numurs'] }}</p>
                                        </td>
                                        <td data-label="Order Date">{{ $orders[$x]->izpildes_datums }}</td>
                                        <td data-label="Total Price">{{ number_format($orders[$x]->cena, 2, ".", "") }} €</td>
                                        <td data-label="Items"><a href="{{ url('order/' . $orders[$x]->id) }}"><x-button type="button">{{ __('messages.View') }}</x-button></a></td>
                                        <td data-label="Invoice"><a href="{{ url('order/' . $orders[$x]->id . '/invoice') }}"><x-button type="button">{{ __('messages.Download') }}</x-button></a></td>
                                    </tr>   
                                @endfor
                            </tbody>
                        </table>
                    @else
                        <p style="font-weight: bold">{{ __("messages.You haven't made any orders!") }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>