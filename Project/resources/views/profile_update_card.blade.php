<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-form>                       
                <form method="POST" action="{{action([App\Http\Controllers\UserController::class, 'updateCard'])}}">
                    @csrf 
                    <input type="hidden" name="card_id" value="{{ $card->id }}"/>
                    <div>
                        <x-label value="{{ __("messages.Number") }}" for="number"></x-label>
                        <x-input type="number" name="number" id="number" class="block mt-1 w-full" placeholder="{{ $card->numurs }}" value="{{ old('number') }}"></x-input>
                        <x-validation-error class="mb-4" :errors="$errors" title="number"/>  
                    </div>

                    <div>
                        <x-label value="{{ __("messages.CVC") }}" for="cvc"></x-label>
                        <x-input type="number" name="cvc" id="cvc" class="block mt-1 w-full" placeholder="{{ $card->CVC }}" value="{{ old('cvc')}}"></x-input>
                        <x-validation-error class="mb-4" :errors="$errors" title="cvc"/>  
                    </div>

                    <div>
                        <x-label value="{{ __("messages.Expiration Date") }}" for="expiry_date"></x-label>
                        <x-input type="date" name="expiry_date" id="expiry_date" class="block mt-1 w-full" value="{{ $card->termins_lidz }}"></x-input>
                        <x-validation-error class="mb-4" :errors="$errors" title="expiry_date"/>  
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __("messages.Update") }}
                        </x-button>
                    </div>
                </form>
            </x-form>                 
        </div>
    </div>
</x-app-layout>