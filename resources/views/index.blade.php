<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HRIS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div
        class="flex min-h-screen items-center justify-center bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-center z-10">
                @auth
                    <div>
                        <a href="{{ url('/dashboard') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    </div>
                @else
                    <div class="flex gap-4">
                        <div class="bg-red-500 rounded-full p-4">
                            <a href="{{ route('login') }}"
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                                in</a>
                        </div>
                        <div class="bg-red-500 rounded-full p-4">
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        </div>
                    </div>
            @endif
        @endauth
    </div>
    @endif
    <h1
        class="text-3xl font-bold bg-gradient-to-tr from-green-500 via-red-500 to-yellow-500 bg-clip-text text-transparent">
        Makan Bang</h1>
    </div>
</body>

</html>
