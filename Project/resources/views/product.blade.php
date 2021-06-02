<x-app-layout>
    <x-slot name="header">
        
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="prod">
                        <div class="prod-pic">
                            <img class="prod-pic" src="{{ asset('img/test.png') }}" alt="alt"/>
                        </div>
                        <div class="prod-content">
                            <h1>{{ $item->nosaukums }}</h1>
                            <p>{{ $item->apraksts }}</p>
                            <h2>{{ $item->cena }}</h2>
                        </div>
                        
                    </div> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>