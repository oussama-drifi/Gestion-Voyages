<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
</head>
<body class="h-full">
    <div class="min-h-full">
    <nav class="bg-gray-800/50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
            <div class="shrink-0">
                <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" class="size-8" />
            </div>
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                <!-- Current: "bg-gray-950/50 text-white", Default: "text-gray-300 hover:bg-white/5 hover:text-white" -->
                <a href="{{ route('home') }}" @class([
                    'rounded-md px-3 py-2 text-sm font-medium',
                    'bg-gray-950/50 text-white' => request()->routeIs('home'),
                    'text-gray-300 hover:bg-white/5 hover:text-white' => ! request()->routeIs('home'),
                ]) aria-current="{{ request()->routeIs('home') ? 'page' : 'false' }}">Home</a>
                <a href="{{ route('about') }}" @class([
                    'rounded-md px-3 py-2 text-sm font-medium',
                    'bg-gray-950/50 text-white' => request()->routeIs('about'),
                    'text-gray-300 hover:bg-white/5 hover:text-white' => ! request()->routeIs('about'),
                ]) aria-current="{{ request()->routeIs('about') ? 'page' : 'false' }}">About</a>
                <a href="{{ route('contact') }}" @class([
                    'rounded-md px-3 py-2 text-sm font-medium',
                    'bg-gray-950/50 text-white' => request()->routeIs('contact'),
                    'text-gray-300 hover:bg-white/5 hover:text-white' => ! request()->routeIs('contact'),
                ]) aria-current="{{ request()->routeIs('contact') ? 'page' : 'false' }}">Contact</a>
                </div>
            </div>
            </div>
            <div class="hidden md:block">
            <div class="ml-4 flex items-center md:ml-6">
                <button type="button" class="relative rounded-full p-1 text-gray-400 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
                <span class="absolute -inset-1.5"></span>
                <span class="sr-only">View notifications</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                    <path d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                </button>

                <!-- Profile dropdown -->
                <el-dropdown class="relative ml-3">
                <button class="relative flex max-w-xs items-center rounded-full focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">Open user menu</span>
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="size-8 rounded-full outline -outline-offset-1 outline-white/10" />
                </button>
                </el-dropdown>
            </div>
            </div>
        </div>
        </div>
    </nav>

    <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-white">@yield('heading', 'Dashboard')</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 text-gray-100 sm:px-6 lg:px-8">
        @yield('content')
        </div>
    </main>
    </div>

</body>
</html>
