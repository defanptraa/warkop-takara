<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kedai UPIN$IPIN') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://unpkg.com/@fortawesome/fontawesome-free@6.5.0/css/all.min.css" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Sidebar width is fixed at 4rem (64px) across all breakpoints.
           Defining it once here avoids any Tailwind purge / class-mismatch issues
           between the sidebar width and the content's left padding. */
        :root {
            --sidebar-w: 4rem;
        }

        .app-sidebar {
            width: var(--sidebar-w);
        }

        /* Mobile (default): sidebar is an overlay drawer, hidden off-canvas.
           Content never gets pushed — it always spans full width. */
        .app-content {
            padding-left: 0;
        }

        /* Tablet and up: sidebar is permanently docked on the left,
           content gets matching left padding so nothing overlaps. */
        @media (min-width: 1024px) {
            .app-content {
                padding-left: var(--sidebar-w);
            }
        }
    </style>
</head>
<body
    class="font-sans antialiased bg-gray-100"
    x-data="{ sidebarOpen: window.innerWidth >= 1024 }"
    @toggle-sidebar.window="sidebarOpen = !sidebarOpen"
    @resize.window="if (window.innerWidth >= 1024) sidebarOpen = true"
>
    <div class="flex min-h-screen h-screen relative">

        <!-- Sidebar -->
        <div
            x-show="sidebarOpen"
            class="app-sidebar bg-white border-r shadow-sm fixed left-0 top-0 bottom-0 z-30 transition-transform duration-300"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            style="height: 100vh;"
            aria-label="Sidebar"
        >
            @include('layouts.sidebar')
        </div>

        <!-- Overlay for mobile/tablet (only shows when sidebar is open AND we're below lg) -->
        <div
            x-show="sidebarOpen"
            class="fixed inset-0 bg-black bg-opacity-25 z-20 lg:hidden"
            @click="sidebarOpen = false"
            aria-hidden="true"
            style="display: none;"
        ></div>

        <!-- Main Content Area -->
        <div class="app-content flex-1 flex flex-col min-h-screen transition-all duration-300 w-full">

            @include('layouts.navigation')

            @hasSection('header')
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-4 sm:py-5 lg:py-6 px-3 sm:px-5 lg:px-8">
                    @yield('header')
                </div>
            </header>
            @endif

            <main class="flex-1 p-3 sm:p-4 lg:p-6 overflow-auto">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>