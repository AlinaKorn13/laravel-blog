<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="icon" type="x-cion" sizes="16x16" href="{{ asset('favicon.ico') }}">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <style>
            html {
                scroll-behavior: smooth;
            }
        </style>
    </head>
    <body class="">
        <section class="px-6 py-8">
            <nav class="md:flex md:justify-between md:items-center">
                <div>
                    <a href="/">
                        <img src="{{ asset('images/logo.svg') }}" alt="Laracasts Logo" width="165" height="16">
                    </a>
                </div>

                <div class="mt-8 md:mt-0">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/admin/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 uppercase mr-2">Dashboard</a>
                            <a href="{{ url('/admin/statistics') }}" class="text-sm text-gray-700 dark:text-gray-500 uppercase">Statistics</a>
                            <form class="inline mx-2" method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a href="{{ route('logout') }}"  class="text-sm text-gray-700 dark:text-gray-500 uppercase"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 uppercase">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 uppercase">Register</a>
                            @endif
                        @endauth
                    @endif
                    @guest
                        <a href="#newsletter" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                            Subscribe for Updates
                        </a>
                    @endguest
                </div>
            </nav>
            <!-- Page Content -->
            <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
                {{ $slot }}
            </main>

            <footer id="newsletter" class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
                <img src="{{ asset('images/lary-newsletter-icon.svg') }}" alt="" class="mx-auto -mb-6" style="width: 145px;">
                <h5 class="text-3xl">Stay in touch with the latest posts</h5>
                <p class="text-sm mt-3">Promise to keep the inbox clean. No bugs.</p>

                <div class="mt-10">
                    <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

                        <form method="POST" action="/newsletter" class="lg:flex text-sm">
                            @csrf
                            <div class="lg:py-3 lg:px-5 flex items-center">
                                <label for="email" class="hidden lg:inline-block">
                                    <img src="{{ asset('images/mailbox-icon.svg') }}" alt="mailbox letter">
                                </label>
                                <div>
                                    <input id="email" name="email" type="email" placeholder="Your email address"
                                           class="lg:bg-transparent focus:outline-none border-0 py-2 lg:py-0 pl-4 focus-within:outline-none" required>
                                    @error('email')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit"
                                    class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8"
                            >
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>
            </footer>
        </section>

        @if (session()->has('success'))
            <x-popup :message="session()->get('success')" class="bg-blue-500 text-white" />
        @elseif (session()->has('info'))
            <x-popup :message="session()->get('info')" class="bg-white text-black border-2 border-blue-500" />
        @endif
    </body>
</html>
