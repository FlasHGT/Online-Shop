<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="prod">
                        <div class="prod-pic">
                            <img class="prod-pic" src="{{ asset('img/test.png') }}" alt="alt"/>
                            <x-button class="prod-btn" item-id="{{ $item->id }}" type="button">
                                @if ($item->inCart == 0)
                                    {{ __("messages.Add To Cart") }}
                                @else
                                    {{ __("messages.Remove From Cart") }}
                                @endif
                            </x-button>
                        </div>
                        <div class="prod-content">
                            <h1>{{ $item->nosaukums }}</h1>
                            <p class="prod-desc">{{ __("messages." . $item->apraksts) }}</p>
                            
                            @if ($item->atlaides_procenti)
                                <p class="prod-price"><del>{{ number_format($item->sakuma_cena, 2, ".", "") }} €</del></p>
                                <p class="prod-price"><span style="color:red;">{{ number_format($item->cena, 2, ".", "") }} €</span></p>
                            @else
                                <br>
                                <p class="prod-price">{{ number_format($item->cena, 2, ".", "") }} €</p>
                            @endif
                        </div>
                        
                    </div> 
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function () {    
            $(".prod-btn").on('click', function (e) {
                var url = "{{ url('cart') }}";
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "POST",
                    url: url,
                    data: { id: $(e.target).attr('item-id'), _token: CSRF_TOKEN },
                    success: function (data) {
                        if ($(e.target).text().trim() === "{{ __('messages.Add To Cart') }}") {
                            $(e.target).text("{{ __('messages.Remove From Cart') }}");   
                        }
                        else {
                            $(e.target).text("{{ __('messages.Add To Cart') }}");   
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