<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>


        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    </head>
    <body class="antialiased">
{{--        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">--}}
{{--            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">--}}
{{--                <div class="flex items-center pt-8 sm:justify-start sm:pt-0">--}}
{{--                    <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">--}}
{{--                       --}}
{{--                    </div>--}}

{{--                    <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">--}}
{{--                        --}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
<div class="bg-white min-h-full px-4 py-16 sm:px-6 sm:py-24 md:grid md:place-items-center lg:px-8">
    <a href="/">
        {{--    <svg class="w-16 h-16" viewbox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
        {{--        <path d="M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z" fill="#6875F5"/>--}}
        {{--        <path d="M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z" fill="#6875F5"/>--}}
        {{--    </svg>--}}

        <img class="h-32 w-auto"
             src="{{asset('/images/logo/2.png')}}"
             alt="ABCO">
    </a>
    <div class="max-w-max mx-auto">
        <main class="sm:flex">
            <p class="text-4xl font-extrabold text-indigo-600 sm:text-5xl"> @yield('code')</p>
            <div class="sm:ml-6">
                <div class="sm:border-l sm:border-gray-200 sm:pl-6">
                    <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">@yield('message')</h1>
                    <p class="mt-1 text-base text-gray-500">Please check the URL in the address bar and try again.</p>
                </div>
                <div class="mt-10 flex space-x-3 sm:border-l sm:border-transparent sm:pl-6">
                    <a href="/" class="inline-flex items-center px-4 py-2 border border-transparent text-sm
                    font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"> Go back home </a>
                </div>
            </div>
        </main>
    </div>
</div>

    </body>
</html>
