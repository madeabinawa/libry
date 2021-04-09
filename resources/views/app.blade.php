<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" type="image/png" sizes="32x32" href="https://laravel.com/img/favicon/favicon-32x32.png">
        <title>{{config('app.name')}} | @yield('title')</title>

        {{-- stylesheet assets --}}
        <link rel="stylesheet" href="{{asset("css/app.css")}}">
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
        {{-- <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
            integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
            integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
            crossorigin="anonymous" /> --}}
    </head>

    <body>
        <div x-data="{ sidebarOpen: false, darkMode: false }" :class="{ 'dark': darkMode }">
            <div class="flex h-screen bg-gray-100 dark:bg-gray-800 font-roboto">
                <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
                    class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>

                <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
                    class="fixed z-30 inset-y-0 left-0 w-60 transition duration-300 transform bg-white dark:bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
                    <div class="flex items-center justify-center mt-8">
                        <div class="flex items-center">
                            <span class="text-gray-800 dark:text-white text-2xl font-semibold">Dashboard</span>
                        </div>
                    </div>

                    <nav class="flex flex-col mt-10 px-4 text-center">
                        <a href="{{route('buku.index')}}"
                            class="{{(request()->is('buku')) ? 'bg-gray-200 text-gray-700' : ' text-gray-600'}} py-2 text-sm dark:text-gray-100 dark:bg-gray-800 rounded">Buku</a>
                        <a href="{{route('penerbit.index')}}"
                            class="{{(request()->is('penerbit')) ? 'bg-gray-200 text-gray-700' : ' text-gray-600'}} mt-3 py-2 text-sm dark:text-gray-100 dark:bg-gray-800 rounded">Penerbit</a>
                        <a href="{{route('kategori.index')}}"
                            class="{{(request()->is('kategori')) ? 'bg-gray-200 text-gray-700' : ' text-gray-600'}} mt-3 py-2 text-sm dark:text-gray-100 dark:bg-gray-800 rounded">Kategori</a>
                        <a href="#"
                            class="{{(request()->is('transaksi')) ? 'bg-gray-200 text-gray-700' : ' text-gray-600'}} mt-3 py-2 text-sm dark:text-gray-100 dark:bg-gray-800 rounded">Contacts</a>
                        <a href="#"
                            class="{{(request()->is('user')) ? 'bg-gray-200 text-gray-700' : ' text-gray-600'}} mt-3 py-2 text-sm dark:text-gray-100 dark:bg-gray-800 rounded">Settings</a>
                    </nav>
                </div>

                <div class="flex-1 flex flex-col overflow-hidden">
                    <header class="flex justify-between items-center p-6">
                        <div class="flex items-center space-x-4 lg:space-x-0">
                            <button @click="sidebarOpen = true"
                                class="text-gray-500 dark:text-gray-300 focus:outline-none lg:hidden">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>


                            <div>
                                <h1 class="text-2xl font-medium text-gray-800 dark:text-white">
                                    @yield('page-title')
                                </h1>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <button @click="darkMode = !darkMode"
                                class="flex text-gray-600 dark:text-gray-300 focus:outline-none"
                                aria-label="Color Mode">
                                <svg x-show="darkMode" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <svg x-show="!darkMode" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                                </svg>
                            </button>
                            <button class="flex text-gray-600 dark:text-gray-300 focus:outline-none">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>

                            <button class="flex text-gray-600 dark:text-gray-300 focus:outline-none">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>

                            <div x-data="{ dropdownOpen: false }" class="relative">
                                <button @click="dropdownOpen = ! dropdownOpen"
                                    class="flex items-center space-x-2 relative focus:outline-none">
                                    <h2 class="text-gray-700 dark:text-gray-300 text-sm hidden sm:block">Jones Ferdinand
                                    </h2>
                                    <div class="h-9 w-9 rounded-full border-2 border-purple-500 object-cover"></div>
                                </button>

                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10"
                                    x-show="dropdownOpen"
                                    x-transition:enter="transition ease-out duration-100 transform"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75 transform"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95" @click.away="dropdownOpen = false">
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-600 hover:text-white">Profile</a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-600 hover:text-white">Tickets</a>
                                    <button
                                        class="block px-4 py-2 text-sm text-left text-gray-700 hover:bg-purple-600 hover:text-white w-full"
                                        onclick="event.preventDefault(); getElementById('logout-form').submit()">Logout</button>

                                    <form id="logout-form" action="{{route('logout')}}" method="post">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </header>

                    <main class="flex-1 overflow-x-hidden overflow-y-auto">
                        <div class="container mx-auto px-6 py-8">
                            <div>
                                @yield('main')
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>


        {{-- javascript --}}
        <script src="{{asset("js/app.js")}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
            integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
            integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
            crossorigin="anonymous"></script>
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
        @yield('javascript')

        @if (\Session::has('success'))
        <script>
            swal({
                icon: "success",
                title: "Success",
                text: "{!!Session::get('success')!!}",
                button: "OK",
                timer: 3000
            });
        </script>
        @endif
    </body>

</html>
