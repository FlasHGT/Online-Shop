<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="p-2 flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('main') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>
            </div>

            <div class="flex items-center search_wrap search_wrap_1">
                <div class="search_box">
                    <form method="GET" action="{{action([App\Http\Controllers\ItemController::class, 'showMain'])}}">
                        <input type="text" name="search" id="search" class="input" placeholder="Search..." value="{{ old('search')}}">
                        <button type="submit"> 
                            <div class="btn btn_common">
                                <i class="fas fa-search"></i>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">       
                <div class="dropdown mr-5">
                    <button class="nav_btn flex items-center">
                        <i class="fas fa-language"></i>
                    </button>

                    <div class="dropdown-content">
                        <x-dropdown-link href="{{ url('lang/en') }}">EN</x-dropdown-link>
                        <x-dropdown-link href="{{ url('lang/lv') }}">LV</x-dropdown-link>
                    </div>
                </div>
                
                <div class="mr-5">
                    <form method="GET" action="{{ route('cart') }}">
                    @csrf
                        <button class="nav_btn flex items-center">  
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </form>
                </div>
                
                <div class="dropdown mr-5">
                    <button class="nav_btn flex items-center">
                        <i class="fas fa-user"></i>
                    </button>

                    <div class="dropdown-content">
                        @auth
                            <x-dropdown-link href="{{ route('profile') }}">{{ __('messages.Profile') }}</x-dropdown-link>
                            <x-dropdown-link href="{{ route('orders') }}">{{ __('messages.Orders') }}</x-dropdown-link>
                            
                            <div>                             
                                <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('messages.Logout') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        @endauth

                        @guest
                            <x-dropdown-link href="{{ route('login') }}">{{ __('messages.Log in') }}</x-dropdown-link>                           
                            <x-dropdown-link href="{{ route('register') }}">{{ __('messages.Register') }}</x-dropdown-link>
                        @endguest
                    </div>
                </div> 
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center nav_btn mobile_nav_btn">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- Responsive Settings Options -->
        <div class="responsive-nav">
            @auth
                <x-dropdown-link href="{{ route('cart') }}">{{ __('messages.Cart') }}</x-dropdown-link>
                <x-dropdown-link href="{{ route('profile') }}">{{ __('messages.Profile') }}</x-dropdown-link>
                <x-dropdown-link href="{{ route('orders') }}">{{ __('messages.Orders') }}</x-dropdown-link>

                <div>                             
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf

                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('messages.Logout') }}
                        </x-dropdown-link>
                    </form>
                </div>
                
                <div class="responsive-nav-lan">
                    <x-dropdown-link href="{{ url('lang/en') }}">EN</x-dropdown-link>
                    <x-dropdown-link href="{{ url('lang/lv') }}">LV</x-dropdown-link>
                </div>
            @endauth

            @guest

                <x-dropdown-link href="{{ route('cart') }}">{{ __('messages.Cart') }}</x-dropdown-link>
                <x-dropdown-link href="{{ route('login') }}">{{ __('messages.Log in') }}</x-dropdown-link>
                <x-dropdown-link href="{{ route('register') }}">{{ __('messages.Register') }}</x-dropdown-link>
                
                <div class="responsive-nav-lan">
                    <x-dropdown-link href="{{ url('lang/en') }}">EN</x-dropdown-link>
                    <x-dropdown-link href="{{ url('lang/lv') }}">LV</x-dropdown-link>
                </div>
            @endguest
        </div>
    </div>
</nav>