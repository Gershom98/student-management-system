<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Student Management System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Vite Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full font-sans antialiased bg-slate-50 dark:bg-zinc-950 text-slate-800 dark:text-zinc-200">

    <div class="min-h-full flex flex-col justify-between">

        <!-- Navbar Header -->
        <header
            class="w-full border-b border-slate-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">

                <!-- App Logo -->
                <div class="flex items-center gap-3">
                    <div
                        class="h-10 w-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-bold text-xl shadow-md">
                        S
                    </div>
                    <div class="flex flex-col">
                        <span
                            class="font-extrabold text-lg tracking-tight text-slate-900 dark:text-white leading-none">SmsPortal</span>
                        <span
                            class="text-[10px] text-slate-500 dark:text-zinc-400 font-medium tracking-wider uppercase mt-0.5">Student
                            Management</span>
                    </div>
                </div>

                <!-- Auth Navigation -->
                @if (Route::has('login'))
                <nav class="flex items-center gap-2">
                    @auth
                    <a href="{{ url('/dashboard') }}"
                        class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow transition">
                        Dashboard
                    </a>
                    @else
                    <!-- Login Link -->
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-sm font-semibold text-slate-700 dark:text-slate-200 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg transition">
                        Log in
                    </a>

                    <!-- Register Link (Mtindo mmoja kabisa na Login) -->
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 text-sm font-semibold text-slate-700 dark:text-slate-200 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg transition">
                        Register
                    </a>
                    @endif
                    @endauth
                </nav>
                @endif
            </div>
        </header>

        <!-- Main Content Area -->
        <main
            class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16 flex flex-col justify-center">

            <!-- Hero Section -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span
                    class="inline-block px-3.5 py-1.5 rounded-full text-xs font-semibold bg-indigo-100 dark:bg-indigo-950 text-indigo-700 dark:text-indigo-300 mb-6">
                    Academic Operations & Management
                </span>

                <h1
                    class="text-4xl sm:text-6xl font-extrabold tracking-tight text-slate-900 dark:text-white mb-6 leading-tight">
                    Simplify Student Data & Campus Operations
                </h1>

                <p
                    class="text-base sm:text-lg text-slate-600 dark:text-zinc-400 leading-relaxed mb-8 max-w-2xl mx-auto">
                    A centralized platform designed for managing student profiles, class enrollments, academic
                    progression, and institutional records seamlessly.
                </p>

                <!-- Call To Action Buttons -->
                <div class="flex flex-wrap items-center justify-center gap-4">
                    @auth
                    <a href="{{ url('/dashboard') }}"
                        class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm shadow-md transition">
                        Access Dashboard
                    </a>
                    @else
                    <a href="{{ route('login') }}"
                        class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm shadow-md transition">
                        Get Started (Log In)
                    </a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="px-6 py-3 rounded-xl bg-slate-200 dark:bg-zinc-800 text-slate-800 dark:text-zinc-100 hover:bg-slate-300 dark:hover:bg-zinc-700 font-semibold text-sm transition">
                        Register Account
                    </a>
                    @endif
                    @endauth
                </div>
            </div>

            <!-- Features Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div
                    class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Student Profiles</h3>
                    <p class="text-sm text-slate-600 dark:text-zinc-400">
                        Efficiently register students, manage personal details, and track enrollment status.
                    </p>
                </div>

                <div
                    class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Courses & Curriculum</h3>
                    <p class="text-sm text-slate-600 dark:text-zinc-400">
                        Organize academic programs, structure modules, and assign subjects seamlessly.
                    </p>
                </div>

                <div
                    class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Grades & Analytics</h3>
                    <p class="text-sm text-slate-600 dark:text-zinc-400">
                        Track exam scores, generate academic transcripts, and analyze performance effortlessly.
                    </p>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer
            class="w-full border-t border-slate-200 dark:border-zinc-800 py-6 text-center text-xs text-slate-500 dark:text-zinc-500">
            &copy; {{ date('Y') }} Student Management System (SMS). All rights reserved.
        </footer>

    </div>
</body>

</html>