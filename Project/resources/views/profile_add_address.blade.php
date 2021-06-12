<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-form>                       
                <form method="POST" action="{{action([App\Http\Controllers\UserController::class, 'addAddress'])}}">
                    @csrf 
                    <div>
                        <x-label value="{{ __('messages.City') }}" for="city"></x-label>
                        <x-input type="text" name="city" id="city" class="block mt-1 w-full" placeholder="Jelgava" value="{{ old('city') }}"></x-input>
                        <x-validation-error class="mb-4" :errors="$errors" title="city"/>  
                    </div>

                    <div>
                        <x-label value="{{ __('messages.Street') }}" for="street"></x-label>
                        <x-input type="text" name="street" id="street" class="block mt-1 w-full" placeholder="Rīgas" value="{{ old('street') }}"></x-input>
                        <x-validation-error class="mb-4" :errors="$errors" title="street"/>  
                    </div>

                    <div>
                        <x-label value="{{ __('messages.Home number') }}" for="home_number"></x-label>
                        <x-input type="number" name="home_number" id="home_number" class="block mt-1 w-full" placeholder="1" value="{{ old('home_number') }}"></x-input>
                        <x-validation-error class="mb-4" :errors="$errors" title="home_number"/>  
                    </div>

                    <div>
                        <x-label value="{{ __('messages.Apartment number') }}" for="apartment_number"></x-label>
                        <x-input type="number" name="apartment_number" id="apartment_number" class="block mt-1 w-full" value="{{ old('apartment_number') }}"></x-input>
                        <x-validation-error class="mb-4" :errors="$errors" title="apartment_number"/>  
                    </div>

                    <div>
                        <x-label value="{{ __('messages.Postcode') }}" for="post_code"></x-label>
                        <x-input type="text" name="post_code" id="post_code" class="block mt-1 w-full" placeholder="LV-2000" value="{{ old('post_code') }}"></x-input>
                        <x-validation-error class="mb-4" :errors="$errors" title="post_code"/>  
                    </div>                                           

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __("messages.Add") }}
                        </x-button>
                    </div>
                </form>
            </x-form>                 
        </div>
    </div>
</x-app-layout>