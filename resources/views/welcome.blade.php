<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toll Tax Management System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        .bg-dots-darker {
            background-image: url('https://www.transparenttextures.com/patterns/asfalt-dark.png');
        }
        .custom-button {
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: white;
            border-radius: 0.5rem;
            transition: all 0.3s ease-in-out;
        }
        .custom-button:hover {
            transform: translateY(-4px);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900">
    <div class="relative min-h-screen flex flex-col justify-center items-center bg-dots-darker bg-center">
    @if (Route::has('login'))
                <div class="mt-12 space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="custom-button bg-blue-600 hover:bg-blue-700 focus:ring focus:ring-blue-300">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="custom-button bg-green-600 hover:bg-green-700 focus:ring focus:ring-green-300">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="custom-button bg-gray-600 hover:bg-gray-700 focus:ring focus:ring-gray-300">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        <div class="max-w-7xl mx-auto p-6 lg:p-8 text-center">
            <h1 class="text-5xl font-bold text-gray-900 dark:text-white">Welcome to the Toll Tax Management System!</h1>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Manage toll tax efficiently and streamline vehicle tracking. Your journey starts here!</p>

            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg flex flex-col transition-transform transform hover:scale-105">
                    <div class="flex items-center justify-center h-16 w-16 bg-blue-50 dark:bg-blue-800/20 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-7 h-7 stroke-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v4.5a4.5 4.5 0 004.5 4.5h9a4.5 4.5 0 004.5-4.5V7M3 7h18M3 7l1.5 2.25M21 7l-1.5 2.25" />
                        </svg>
                    </div>
                    <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Easy Toll Payments</h2>
                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Pay your tolls easily online and track your payments seamlessly.</p>
                </div>

                <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg flex flex-col transition-transform transform hover:scale-105">
                    <div class="flex items-center justify-center h-16 w-16 bg-green-50 dark:bg-green-800/20 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-7 h-7 stroke-green-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 7v14a1 1 0 001 1h16a1 1 0 001-1V7M3 7l1.5 1.5M21 7l-1.5 1.5" />
                        </svg>
                    </div>
                    <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Vehicle Tracking</h2>
                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Monitor vehicles and their toll usage with our tracking system.</p>
                </div>

                <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg flex flex-col transition-transform transform hover:scale-105">
                    <div class="flex items-center justify-center h-16 w-16 bg-red-50 dark:bg-red-800/20 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-7 h-7 stroke-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25V15m0 0v3m0-3h3m-3 0H9m9-4.5a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Real-Time Analytics</h2>
                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Get insights into toll transactions and vehicle data in real-time.</p>
                </div>
            </div>

          
        </div>
    </div>
</body>
</html>