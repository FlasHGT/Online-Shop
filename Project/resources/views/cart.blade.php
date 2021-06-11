<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>Cart Items</h1>
                    
                    <div class="cart">
                        @isset ($items)
                            <table class="table">
                                <thead>
                                    <th>Item</th>
                                    <th>Item Name</th>
                                    <th>Item Price</th>
                                    <th>Item Count</th>
                                    <th>Item Total</th>
                                </thead>
                                <tbody>
                                    @for ($x = 0; $x < count($items); $x++)
                                        <tr item-id="{{ $items[$x]['id'] }}">
                                            <td class="img-button" data-label="Item">
                                                <a href="{{ url('product/' . $items[$x]['id']) }}"><img src="{{ asset('img/test.png') }}" alt="alt"/></a>
                                                <x-button class="cart-btn" item-id="{{ $items[$x]['id'] }}" type="button">Remove From Cart</x-button>
                                            </td>
                                            <td data-label="Item Name"><a href="{{ url('product/' . $items[$x]['id']) }}">{{ $items[$x]['nosaukums'] }}</a></td>
                                            <td data-label="Item Price">
                                                {{ number_format($items[$x]['cena'], 2) }} €
                                            </td>
                                            <td class="cart-count" data-label="Item Count">
                                                <div class="cart-buttons">
                                                    <p class="{{ 'item-qty' . $items[$x]['id'] }}">{{ $item_qty[$x] }}</p>
                                                    <x-button item-id="{{ $items[$x]['id'] }}" increase=0 class="qty-btn" type="button">-</x-button>
                                                    <x-button item-id="{{ $items[$x]['id'] }}" increase=1 class="qty-btn" type="button">+</x-button>
                                                </div>
                                            </td>
                                            <td class="total-item {{ 'total-item' . $items[$x]['id'] }}" qty={{ $item_qty[$x] }} val={{ $items[$x]['cena'] }} data-label="Item Total">
                                                {{ number_format($items[$x]['cena'] * $item_qty[$x], 2) }} €
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                            
                            <div class="cart-order">
                                <h1 class="cart-total" val=2000></h1>
                                <x-button class="" type="button">Make Order</x-button>
                            </div>
                        @endisset
                    </div>     
                </div>
            </div>
        </div>
    </div>
    
    <script>
        checkItemCount();
        updateTotal();

        function updateTotal () {
            let total = 0;
        
            $('.total-item').each(function() {     
                total += parseInt($(this).text());
            });

            $('.cart-total').text('Total: ' + total + '.00 €');
        }

        function checkItemCount() {
            if (!$('tr[item-id]').length) {
                $('.table').remove();
                $('.cart').text('You haven\'t added any items to the cart!');
            }
        }

        $(document).ready(function () {           
            $('.qty-btn').on('click', function (e) {
                var url = "{{ url('cart/qty') }}";
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'); 
                
                var bool = $(e.target).attr('increase');
                var currID = $(e.target).attr('item-id');
                
                var totalPriceTag = $('.total-item' + currID);
                var totalPriceVal = parseInt(totalPriceTag.attr('val'));
                
                var qtyTag = $('.item-qty' + currID);
                var qtyVal = parseInt(qtyTag.text());
                
                $.ajax({
                    type: "POST",
                    url: url,
                    data: { id: currID, _token: CSRF_TOKEN, increase: bool },
                    success: function (data) {
                        if (bool == 1)
                        {
                            qtyVal++;
                        }
                        else if (qtyVal != 1) {
                            qtyVal--;
                        }
                        
                        totalPriceTag.text((totalPriceVal * qtyVal) + '.00 €');          
                        qtyTag.text(qtyVal);
                        
                        updateTotal();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            })
            
            $(".cart-btn").on('click', function (e) {
                var url = "{{ url('cart') }}";
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var btn = $(this);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: { id: btn.attr('item-id'), _token: CSRF_TOKEN },
                    success: function (data) {
                       btn.closest('tr').remove();
                       
                       checkItemCount();
                       updateTotal();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            })
        });        
    </script>      
</x-app-layout>

