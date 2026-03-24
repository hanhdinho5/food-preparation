<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        crossorigin="anonymous">

    <!-- Main Styling -->
    <link href="{{ asset('./assets/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="m-0 font-sans antialiased text-slate-500">
    <div class="absolute w-full min-h-screen bg-gray-100">

        @auth
            {{-- sidebar for auth user --}}
            @include('layouts.sidebar')
        @else
            {{-- navbar for guest user --}}
            @include('layouts.navigation')
        @endauth

        @if (session()->has('success'))
            <div x-data="{ open: true }" x-show="open" id="toast-success"
                class="fixed flex items-center top-5 right-5 z-10 w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm"
                role="alert">
                <div
                    class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">
                    {{ session('success') }}
                </div>
                <button type="button" @click="open = false"
                    class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        @if (session()->has('error'))
            <div x-data="{ open: true }" x-show="open" id="toast-danger"
                class="fixed flex items-center mx-auto mt-4 w-full max-w-xs top-5 right-5 z-10 p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm"
                role="alert">
                <div
                    class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                    </svg>
                    <span class="sr-only">Error icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">
                    {{ session('error') }}
                </div>
                <button type="button" @click="open = false"
                    class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    data-dismiss-target="#toast-danger" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        <div id="comment-notification"
            class="hidden fixed flex items-center mx-auto mt-4 w-full max-w-xs top-5 right-5 z-10 p-4 mb-4 text-gray-500 shadow-sm flex-col bg-white rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-8 h-8 rounded-lg border border-blue-100 text-blue-400 bg-blue-50" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex flex-col ml-3">
                        <div class="font-medium leading-none">New Comment</div>
                        <p id='comment-notification-message' class="text-sm text-gray-600 leading-none mt-2"></p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Page Content -->
        <main class="relative min-h-[90vh] transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
            {{-- header --}}
            @isset($header)
                <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start"
                    navbar-main navbar-scroll="false">
                    <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                        <nav>
                            {{ $header }}
                        </nav>

                    </div>
                </nav>
            @endisset

            {{-- content --}}
            {{ $slot }}

        </main>

        @include('layouts.footer')
    </div>
</body>

<script src="{{ asset('./assets/js/argon-dashboard-tailwind.js?v=1.0.1') }}" async></script>

<script>
    let hideTimeout = null;

    document.addEventListener('DOMContentLoaded', () => {

        if (!window.Echo) {
            console.log('Echo is not initialized yet!');
            return;
        }

        console.log('echo is ', window.Echo);

        window.Echo.channel('MyComment')
            .subscribed(() => {
                console.log('successfully subcribed to channel')
            })
            .error((error) => {
                console.error('failed:', error)
            })
            .listen('.comment', (e) => {
                console.log('Received broadcast event:', e);

                const currentUserId = @json(Auth::check() ? Auth::user()->id : null);

                // Check if the current user is the post creator
                if (e.creator === currentUserId) {
                    showNotification(e.message);
                }
            });
    });

    function showNotification(message) {
        const notificationEl = document.getElementById('comment-notification');
        const notificationMessage = document.getElementById('comment-notification-message');

        notificationEl.classList.remove('hidden');
        notificationMessage.innerHTML = message;

        // Clear previous timeout if any
        if (hideTimeout) {
            clearTimeout(hideTimeout);
        }

        // Auto-hide after 10 seconds
        hideTimeout = setTimeout(() => {
            notificationEl.classList.add('hidden');
        }, 10000)
    }
</script>

@yield('scripts')

</html>
