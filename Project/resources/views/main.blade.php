<x-app-layout>
    <x-slot name="header">
        
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <span>
                        {{ $items->links() }}
                    </span>
                    
                    <div class="items">
                        @foreach ($items as $item)              
                            <div class="item">
                                <a href="{{ url('product/' . $item->id) }}">
                                    <img src="{{ asset('img/test.png') }}" alt="alt"/>
                                    <h1>{{ $item->nosaukums }}</h1>
                                </a>
                                @if ($item->atlaides_cena)
                                    <p class="main-price"><del>{{ $item->cena }}.00 €</del></p>
                                    <p class="main-price"><span style="color:red;">{{ $item->atlaides_cena }}.00 €</span></p>
                                @else
                                    <p class="main-price">{{ $item->cena }}.00 €</p>
                                @endif

                                <x-button class="main-btn" item-id="{{ $item->id }}" type="button">
                                    @if ($item->inCart == 0)
                                        Add To Cart
                                    @else
                                        Remove From Cart
                                    @endif
                                </x-button>
                            </div> 
                        @endforeach
                    </div>
                    
                    <span class="bot-nav">
                        {{ $items->links() }}
                    </span>
                    
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function () {    
            $(".main-btn").on('click', function (e) {
                var url = "{{ url('cart') }}";
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "POST",
                    url: url,
                    data: { id: $(e.target).attr('item-id'), _token: CSRF_TOKEN },
                    success: function (data) {
                        if ($(e.target).text().trim() === "Add To Cart") {
                            $(e.target).text("Remove From Cart");   
                        }
                        else {
                            $(e.target).text("Add To Cart");   
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            })
        });        
    </script>        
</x-app-layout>