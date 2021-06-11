<x-app-layout>
    <div class="py-12 main-container">
        <div class="main-filters max-w-7xl sm:px-6 lg:px-8 bg-white shadow-sm sm:rounded-lg">            
            <div class="main-filters-items">
                <h1>Categories</h1>
            
                <div class="main-filter-container">
                    @if(!isset($selectedCategory))
                        <a class="category-name category-name-selected" href="{{ route('main') }}"><p>Visas preces</p></a>
                    @else 
                        <a class="category-name" href="{{ route('main') }}"><p>Visas preces</p></a>
                    @endif

                    @foreach ($categories as $category)
                        @isset ($selectedCategory)
                            @if ($selectedCategory == $category->id)
                                <a class="category-name category-name-selected" href="{{ route('main', ['category' => $category->id]) }}"><p>{{ $category->nosaukums }}</p></a>
                                @continue
                            @endif
                        @endisset
                            <a class="category-name" href="{{ route('main', ['category' => $category->id]) }}"><p>{{ $category->nosaukums }}</p></a>
                    @endforeach
                </div>

                <h1>Filters</h1>

                <div class="main-filter-container">
                    <div class="dropdown">
                        <p class="filter-name">Sort by</p>
                        
                        <div class="dropdown-content">
                            <x-dropdown-link class="current-filter-link" href="{{ route('main', ['category' => request()->category, 'search' => request()->search, 'sort' => 'atoz']) }}">Names from A to Z</x-dropdown-link>
                            <x-dropdown-link class="current-filter-link" href="{{ route('main', ['category' => request()->category, 'search' => request()->search, 'sort' => 'ztoa']) }}">Names from Z to A</x-dropdown-link>
                            <x-dropdown-link class="current-filter-link" href="{{ route('main', ['category' => request()->category, 'search' => request()->search, 'sort' => 'ltoh']) }}">Lowest to highest price</x-dropdown-link>
                            <x-dropdown-link class="current-filter-link" href="{{ route('main', ['category' => request()->category, 'search' => request()->search, 'sort' => 'htol']) }}">Highest to lowest price</x-dropdown-link>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        
        <div class="main-items max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (isset($items) && !$items->isEmpty()) 
                        <span>
                            {{ $items->withQueryString()->links() }}
                        </span> 
                    
                        <div class="items">
                            @foreach ($items as $item)              
                                <div class="item">
                                    <a href="{{ url('product/' . $item->id) }}">
                                        <img src="{{ asset('img/test.png') }}" alt="alt"/>
                                        <h1>{{ $item->nosaukums }}</h1>
                                    </a>
                                    @if ($item->atlaides_procenti)
                                        <p class="main-price"><del>{{ number_format($item->sakuma_cena, 2) }} €</del></p>
                                        <p class="main-price"><span style="color:red;">{{ number_format($item->cena, 2) }} €</span></p>
                                    @else
                                        <br>
                                        <p class="main-price">{{ number_format($item->cena, 2) }} €</p>
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
                            {{ $items->withQueryString()->links() }}
                        </span>
                    @else
                        <p style="font-weight: bold;">No items found with the current search term!</p>
                    @endif
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