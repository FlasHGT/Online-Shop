<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-form>                       
                <form method="POST" action="{{action([App\Http\Controllers\UserController::class, 'profileInfoUpdate'])}}">
                    @csrf 
                    <div>
                        <x-label value="E-mail" for="email"></x-label>
                        <x-input type="email" name="email" id="email" class="block mt-1 w-full" placeholder="{{ $user->email }}" value="{{ old('email') }}"></x-input>
                        <x-validation-error class="mb-4" :errors="$errors" title="email"/>  
                    </div>

                    <div>
                        <x-label value="Password" for="password"></x-label>
                        <x-input type="password" name="password" id="password" class="block mt-1 w-full" value="{{ old('password')}}"></x-input>
                        <x-validation-error class="mb-4" :errors="$errors" title="password"/>  
                    </div>

                    <div>
                        <x-label value="Confirm Password" for="password_confirmation"></x-label>
                        <x-input type="password" name="password_confirmation" id="password_confirmation" class="block mt-1 w-full" value="{{ old('password_confirmation') }}"></x-input>
                        <x-validation-error class="mb-4" :errors="$errors" title="password_confirmation"/>  
                    </div>

                    <div>
                        <x-label value="Name" for="name"></x-label>
                        <x-input type="text" name="name" id="name" class="block mt-1 w-full" placeholder="{{ $user->vards }}" value="{{ old('name') }}"></x-input>
                        <x-validation-error class="mb-4" :errors="$errors" title="name"/>  
                    </div>

                    <div>
                        <x-label value="Surname" for="surname"></x-label>
                        <x-input type="text" name="surname" id="surname" class="block mt-1 w-full" placeholder="{{ $user->uzvards }}" value="{{ old('surname') }}"></x-input>
                        <x-validation-error class="mb-4" :errors="$errors" title="surname"/>  
                    </div>

                    <div>
                        <x-label value="Birthday" for="birthday"></x-label>
                        <x-input type="date" name="birthday" id="birthday" class="block mt-1 w-full" placeholder="{{ $user->dzimsanas_diena }}" value="{{ $user->dzimsanas_diena }}"></x-input>
                        <x-validation-error class="mb-4" :errors="$errors" title="birthday"/>  
                    </div>

                    <div>
                        <x-label value="Mobile Phone" for="mobile_phone"></x-label>
                        <x-input type="number" name="mobile_phone" id="mobile_phone" class="block mt-1 w-full" placeholder="{{ $user->telefona_nr }}" value="{{ $user->telefona_nr }}"></x-input>
                        <x-validation-error class="mb-4" :errors="$errors" title="mobile_phone"/>  
                    </div>                                               

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            Update
                        </x-button>
                    </div>
                </form>
            </x-form>         
        </div>
    </div>
</x-app-layout>