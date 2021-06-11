<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-form>                       
                <form method="POST" action="{{action([App\Http\Controllers\UserController::class, 'addCard'])}}">
                    @csrf 
                    <div>
                        <x-label value="Number" for="number"></x-label>
                        <x-input type="number" name="number" id="number" class="block mt-1 w-full" placeholder="5555555555555555" value="{{ old('number') }}"></x-input>
                        <x-validation-error class="mb-4" :errors="$errors" title="number"/>  
                    </div>

                    <div>
                        <x-label value="CVC" for="cvc"></x-label>
                        <x-input type="number" name="cvc" id="cvc" class="block mt-1 w-full" placeholder="111" value="{{ old('cvc')}}"></x-input>
                        <x-validation-error class="mb-4" :errors="$errors" title="cvc"/>  
                    </div>

                    <div>
                        <x-label value="Expiration Date" for="expiry_date"></x-label>
                        <x-input type="date" name="expiry_date" id="expiry_date" class="block mt-1 w-full" value="{{ old('expiry_date') }}"></x-input>
                        <x-validation-error class="mb-4" :errors="$errors" title="expiry_date"/>  
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            Add
                        </x-button>
                    </div>
                </form>
            </x-form>                 
        </div>
    </div>
</x-app-layout>