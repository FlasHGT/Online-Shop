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
                                    <h2>{{ $item->cena }}</h2>
                                </a>
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
</x-app-layout>