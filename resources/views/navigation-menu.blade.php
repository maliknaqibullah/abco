<div x-data="{ isMobileNavOpen: false }">
    <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
    <div x-show="isMobileNavOpen" class="fixed inset-0 flex z-40 md:hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>
        <div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-gray-800">
            <div class="absolute top-0 right-0 -mr-12 pt-2">
                <button @click="isMobileNavOpen = !isMobileNavOpen" type="button"
                        class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                    <span class="sr-only">Close sidebar</span>
                    <!-- Heroicon name: outline/x -->
                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="flex-shrink-0 flex items-center px-4">
                <img class="h-16 w-auto"
                     src="{{asset('/images/logo/2.png')}}"
                     alt="ABCO">
            </div>
            <div class="mt-5 flex-1 h-0 overflow-y-auto">
             <nav class="flex-1 px-2 py-4 space-y-1">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
               @can('dashboard')
                        <a href="/"
                           class="{{ (request()->is('/')) ? 'active' : '' }} text-gray-300 group flex items-center px-2
                       py-2 text-sm font-medium rounded-md">
                            <svg class="text-gray-300 mr-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Dashboard
                        </a>
                    @endcan

                    @can('users')
                        <div @click.away="open = false" class="relative" x-data="{ open: false }">
                            <button @click="open = !open" type="button" class="{{ (request()->is('users*')) ? 'active' : ''
                        }} flex items-center w-full text-gray-300
                        hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md"
                                    aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                                <svg class="svg"
                                     xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span class="flex-1 text-left whitespace-nowrap" sidebar-toggle-item>Users</span>
                                <svg fill="currentColor" viewBox="0 0 20 20"
                                     :class="{'rotate-180': open, 'rotate-0': !open}"
                                     class="inline w-4 h-4 mt-1  transition-transform duration-200 transform md:-mt-1">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"></path>
                                </svg>

                            </button>

                            <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="relative right-0 w-full origin-top-right rounded-md shadow-lg">
                                <div class="px-2 py-2 bg-gray-900 rounded-md shadow dark-mode:bg-gray-800">
                                    <a class="{{ (request()->is('users')) ? 'bg-gray-700' : ''
                        }} hover:bg-gray-700 text-gray-300 group flex
                                items-center px-2 py-2 text-sm font-medium rounded-md"
                                       href="{{ route('users.index') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-300 mr-3 flex-shrink-0
                                    h-4 w-4" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                        Users</a>
                                    <a class="{{ (request()->is('users/create*')) ? 'bg-gray-700' : ''
                        }}  hover:bg-gray-700 text-gray-300 group flex items-center px-2 py-2 text-sm font-medium
                        rounded-md"
                                       href="{{ route('users.create') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-300 mr-3 flex-shrink-0
                                    h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                        </svg>
                                        Create User</a>
                                    <a class=" {{ (request()->is('user-roles*')) ? 'bg-gray-700' : ''
                        }} hover:bg-gray-700 text-gray-300 group flex items-center px-2 py-2 text-sm font-medium
                        rounded-md"
                                       href="/user-roles">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-300 mr-3 flex-shrink-0
                                    h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        User Roles</a>
                                    <a class=" {{ (request()->is('permissions*')) ? 'bg-gray-700' : ''
                        }} hover:bg-gray-700 text-gray-300 group flex items-center px-2 py-2
                                    text-sm font-medium rounded-md"
                                       href="/permissions">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-300 mr-3 flex-shrink-0
                                    h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/>
                                        </svg>
                                        Permissions</a>
                                </div>
                            </div>
                        </div>
                    @endcan

                    @can('warehouse')
                    <a href="/warehouse"
                       class="{{ (request()->is('warehouse*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/users -->
                        <svg class="svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
                        </svg>
                        Warehouse
                    </a>
                    @endcan
                    @can('stocks')
                    <a href="/stocks"
                       class="{{ (request()->is('stocks*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/folder -->
                        <svg class="svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                        </svg>
                        Stocks
                    </a>
                
                    @endcan
                        @can('stock-history')
                    <a href="/stock-history"
                        class="{{ (request()->is('stock-history*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/folder -->
                        <svg class="svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Stock History
                    </a>
                    @endcan
{{--                    <a href="/transfer-stocks"--}}
{{--                       class="{{ (request()->is('transfer-stocks*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">--}}
{{--                        <!-- Heroicon name: outline/folder -->--}}
{{--                        <svg class="svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />--}}
{{--                        </svg>--}}
{{--                        Transfer Stock--}}
{{--                    </a>--}}
                    @can('bakery')
                    <a href="/bakeries"
                       class="{{ (request()->is('bakeries*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/chart-bar -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"/>
                        </svg>
                        Bakery
                    </a>
                    @endcan
                    @can('daily_report')
                    <a href="/supply-products"
                       class="{{ (request()->is('supply-products*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/folder -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                        </svg>
                        Daily Distribution
                    </a>
                    @endcan
                    @can('generate_report')
                    <a href="/reports"
                       class="{{ (request()->is('reports*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700
                       hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/folder -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg"  fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                       Generate Reports
                    </a>
                    @endcan
                    @can('supplier')
                    <a href="/supplier"
                       class="{{ (request()->is('supplier*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/calendar -->
                        <svg class="svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7
                                  20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Supplier
                    </a>
                    @endcan
                    @can('schools')
                    <a href="/schools"
                       class="{{ (request()->is('schools*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/inbox -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path
                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                        </svg>
                        Schools
                    </a>
                    @endcan
{{--                    <a href="/school-attendance"--}}
{{--                       class="{{ (request()->is('school-attendance*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">--}}
{{--                        <!-- Heroicon name: outline/inbox -->--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" class="svg" fill="none" viewBox="0 0 24 24"--}}
{{--                             stroke="currentColor" stroke-width="2">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />--}}
{{--                        </svg>--}}
{{--                        Schools Attendance--}}
{{--                    </a>--}}

                    @can('ingredients')
                    <a href="/ingredients"
                       class="{{ (request()->is('ingredients*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/chart-bar -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                        Ingredients
                    </a>
                    @endcan

                </nav>
            </div>
        </div>

        <div class="flex-shrink-0 w-14" aria-hidden="true">

            <!-- Dummy element to force sidebar to shrink to fit close icon -->
        </div>
    </div>

    <!-- Static sidebar for desktop -->
    <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div class="flex-1 flex flex-col min-h-0 bg-gray-800">
            <div class="flex items-center h-16 flex-shrink-0 px-4 bg-gray-900">
                <img class="h-16 w-auto"
                     src="{{asset('/images/logo/2.png')}}"
                     alt="ABCO">
            </div>
            <div class="flex-1 flex flex-col overflow-y-auto">
                <nav class="flex-1 px-2 py-4 space-y-1">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
               @can('dashboard')
                        <a href="/"
                           class="{{ (request()->is('/')) ? 'active' : '' }} text-gray-300 group flex items-center px-2
                       py-2 text-sm font-medium rounded-md">
                            <svg class="text-gray-300 mr-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Dashboard
                        </a>
                    @endcan

                    @can('users')
                        <div @click.away="open = false" class="relative" x-data="{ open: false }">
                            <button @click="open = !open" type="button" class="{{ (request()->is('users*')) ? 'active' : ''
                        }} flex items-center w-full text-gray-300
                        hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md"
                                    aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                                <svg class="svg"
                                     xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span class="flex-1 text-left whitespace-nowrap" sidebar-toggle-item>Users</span>
                                <svg fill="currentColor" viewBox="0 0 20 20"
                                     :class="{'rotate-180': open, 'rotate-0': !open}"
                                     class="inline w-4 h-4 mt-1  transition-transform duration-200 transform md:-mt-1">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"></path>
                                </svg>

                            </button>

                            <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="relative right-0 w-full origin-top-right rounded-md shadow-lg">
                                <div class="px-2 py-2 bg-gray-900 rounded-md shadow dark-mode:bg-gray-800">
                                    <a class="{{ (request()->is('users')) ? 'bg-gray-700' : ''
                        }} hover:bg-gray-700 text-gray-300 group flex
                                items-center px-2 py-2 text-sm font-medium rounded-md"
                                       href="{{ route('users.index') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-300 mr-3 flex-shrink-0
                                    h-4 w-4" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                        Users</a>
                                    <a class="{{ (request()->is('users/create*')) ? 'bg-gray-700' : ''
                        }}  hover:bg-gray-700 text-gray-300 group flex items-center px-2 py-2 text-sm font-medium
                        rounded-md"
                                       href="{{ route('users.create') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-300 mr-3 flex-shrink-0
                                    h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                        </svg>
                                        Create User</a>
                                    <a class=" {{ (request()->is('user-roles*')) ? 'bg-gray-700' : ''
                        }} hover:bg-gray-700 text-gray-300 group flex items-center px-2 py-2 text-sm font-medium
                        rounded-md"
                                       href="/user-roles">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-300 mr-3 flex-shrink-0
                                    h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        User Roles</a>
                                    <a class=" {{ (request()->is('permissions*')) ? 'bg-gray-700' : ''
                        }} hover:bg-gray-700 text-gray-300 group flex items-center px-2 py-2
                                    text-sm font-medium rounded-md"
                                       href="/permissions">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-300 mr-3 flex-shrink-0
                                    h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/>
                                        </svg>
                                        Permissions</a>
                                </div>
                            </div>
                        </div>
                    @endcan

                    @can('warehouse')
                    <a href="/warehouse"
                       class="{{ (request()->is('warehouse*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/users -->
                        <svg class="svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
                        </svg>
                        Warehouse
                    </a>
                    @endcan
                    @can('stocks')
                    <a href="/stocks"
                       class="{{ (request()->is('stocks*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/folder -->
                        <svg class="svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                        </svg>
                        Stocks
                    </a>
                    @endcan
                        @can('stock-history')
                    <a href="/stock-history"
                        class="{{ (request()->is('stock-history*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/folder -->
                        <svg class="svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Stock History
                    </a>
                    @endcan
{{--                    <a href="/transfer-stocks"--}}
{{--                       class="{{ (request()->is('transfer-stocks*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">--}}
{{--                        <!-- Heroicon name: outline/folder -->--}}
{{--                        <svg class="svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />--}}
{{--                        </svg>--}}
{{--                        Transfer Stock--}}
{{--                    </a>--}}
                    @can('bakery')
                    <a href="/bakeries"
                       class="{{ (request()->is('bakeries*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/chart-bar -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"/>
                        </svg>
                        Bakery
                    </a>
                    @endcan
                    @can('daily_report')
                    <a href="/supply-products"
                       class="{{ (request()->is('supply-products*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/folder -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                        </svg>
                       Daily Distribution
                    </a>
                    @endcan
                    @can('generate_report')
                    <a href="/reports"
                       class="{{ (request()->is('reports*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700
                       hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/folder -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg"  fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                       Generate Reports
                    </a>
                    @endcan
                    @can('supplier')
                    <a href="/supplier"
                       class="{{ (request()->is('supplier*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/calendar -->
                        <svg class="svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7
                                  20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Supplier
                    </a>
                    @endcan
                    @can('schools')
                    <a href="/schools"
                       class="{{ (request()->is('schools*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/inbox -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path
                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                        </svg>
                        Schools
                    </a>
                    @endcan
{{--                    <a href="/school-attendance"--}}
{{--                       class="{{ (request()->is('school-attendance*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">--}}
{{--                        <!-- Heroicon name: outline/inbox -->--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" class="svg" fill="none" viewBox="0 0 24 24"--}}
{{--                             stroke="currentColor" stroke-width="2">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />--}}
{{--                        </svg>--}}
{{--                        Schools Attendance--}}
{{--                    </a>--}}

                    @can('ingredients')
                    <a href="/ingredients"
                       class="{{ (request()->is('ingredients*')) ? 'active' : '' }} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <!-- Heroicon name: outline/chart-bar -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                        Ingredients
                    </a>
                    @endcan

                </nav>
            </div>
        </div>
    </div>
    <div class="md:pl-64 flex flex-col flex-1">

        <div class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow">
            <button @click="isMobileNavOpen = !isMobileNavOpen" type="button"
                    class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden">
                <span class="sr-only">Open sidebar</span>
                <!-- Heroicon name: outline/menu-alt-2 -->
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                </svg>
            </button>
            <div class="flex-1 px-4 flex justify-between">
                <div class="flex-1 flex">
                    <form class="w-full flex md:ml-0" action="#" method="GET">
                        <label for="search-field" class="sr-only">Search</label>
                        <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                            <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                                <!-- Heroicon name: solid/search -->
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                     fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <input id="search-field"
                                   class="block w-full h-full pl-8 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-0 focus:border-transparent sm:text-sm"
                                   placeholder="Search" type="search" name="search">
                        </div>
                    </form>
                </div>
                <div class="ml-4 flex items-center md:ml-6">

                    <button type="button"
                            class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="sr-only">View notifications</span>
                        <!-- Heroicon name: outline/bell -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </button>
                    <!-- Teams Dropdown -->

                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="lg:ml-3 relative">
                            <x-jet-dropdown align="right" width="60">
                                <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </span>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="w-60">
                                        <!-- Team Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manage Team') }}
                                        </div>

                                        <!-- Team Settings -->
                                        <x-jet-dropdown-link
                                            href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                            {{ __('Team Settings') }}
                                        </x-jet-dropdown-link>

                                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                            <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                                {{ __('Create New Team') }}
                                            </x-jet-dropdown-link>
                                        @endcan

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Team Switcher -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>

                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-jet-switchable-team :team="$team"/>
                                        @endforeach
                                    </div>
                                </x-slot>
                            </x-jet-dropdown>
                        </div>
                    @endif

                    <!-- Profile dropdown -->
                    <div class="lg:ml-3 relative">
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover border border-2 border-blue-500"
                                             src="{{ Auth::user()->profile_photo_url }}"
                                             alt="{{ Auth::user()->name }}"/>
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                    <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-jet-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-jet-dropdown-link>
                                @endif

                                <div class="border-t border-gray-100"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                                         @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </x-slot>
                        </x-jet-dropdown>


                    </div>
                </div>
            </div>
        </div>

