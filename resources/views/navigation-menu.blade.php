<nav x-data="{ open: false }" class="">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="">
            <div class="flex">
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    @auth 
                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <!--Team dropdown -->
                            <div class="ms-3 relative">
                                <x-dropdown align="right" width="60">
                                    <x-slot name="trigger">
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ Auth::user()->currentTeam->name }} 

                                                <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                                </svg>
                                            </button>
                                        </span>
                                    </x-slot>

                                    <x-slot name="content">
                                        <div class="w-60">
                                        
                                             <a href="#">Manage Teams</a>
                                             <a href="#">Switch Teams</a>
                                        </div>
                                             </x-slot>
                                </x-dropdown>
                            </div>
                            <!--team dropdown end -->
                        @endif

                        <!--user dropdown -->
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                             <x-slot name="trigger">
                             @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                 <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                            @else
                            <span class="inline-flex rounded-md">
                                 <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ Auth::user()->name }}
                                    <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>
                             @endif
                            </x-slot>

                            <x-slot name="content">
                            <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}"
                                 @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                            </x-dropdown-link>
                            </form>
                            </x-slot>
                            </x-dropdown>
                    </div>

                        
                        <!-- user dropdown end-->
                    @endauth
                </div> 
           </div>
       </div>

       <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
           <div class="pt-4 pb-1 border-t border-gray-200">
                @auth
                    <div class="flex items-center px-4">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="shrink-0 me-3">
                                <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </div>
                        @endif

                        <div>
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                @endauth

                <div class="mt-3 space-y-1">
                    @auth
                       </div>
                @endauth
           </div>
       </div>
</nav>