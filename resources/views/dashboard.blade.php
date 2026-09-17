<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-xl sm:text-2xl text-slate-800 dark:text-zinc-100 leading-tight">
                    Dashboard
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-zinc-400 mt-1">
                    Welcome back, {{ Auth::user()->name }}! Here is what's happening today.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('students.create') }}"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white text-xs sm:text-sm font-semibold rounded-xl shadow-md shadow-indigo-500/20 transition duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Add New Student</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 dark:bg-zinc-950 min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Quick Stats Overview Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                <!-- Stat Card 1: Total Students -->
                <div
                    class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 shadow-sm flex items-center justify-between">
                    <div>
                        <span
                            class="text-xs font-semibold tracking-wider text-slate-500 dark:text-zinc-400 uppercase">Total
                            Registered</span>
                        <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1">{{ $totalStudents }}
                        </h3>
                        <a href="{{ route('students.index') }}"
                            class="inline-flex items-center gap-1 text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:underline mt-2">
                            View All Students &rarr;
                        </a>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Stat Card 2: Active Courses -->
                <div
                    class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 shadow-sm flex items-center justify-between">
                    <div>
                        <span
                            class="text-xs font-semibold tracking-wider text-slate-500 dark:text-zinc-400 uppercase">Active
                            Courses</span>
                        <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1">{{ $totalCourses }}</h3>
                        <a href="{{ route('courses.index') }}"
                            class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:underline mt-2">
                            Manage Courses &rarr;
                        </a>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>

                <!-- Stat Card 3: Grade Reports -->
                <div
                    class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 shadow-sm flex items-center justify-between sm:col-span-2 lg:col-span-1">
                    <div>
                        <span
                            class="text-xs font-semibold tracking-wider text-slate-500 dark:text-zinc-400 uppercase">Grade
                            Reports</span>
                        <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1">{{ $totalGrades }}</h3>
                        <a href="{{ route('grades.index') }}"
                            class="inline-flex items-center gap-1 text-xs font-semibold text-purple-600 dark:text-purple-400 hover:underline mt-2">
                            View Reports &rarr;
                        </a>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-purple-50 dark:bg-purple-950/60 text-purple-600 dark:text-purple-400 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>

            </div>

            <!-- Recently Registered Students Table Card -->
            <div
                class="bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 rounded-2xl shadow-sm overflow-hidden">
                <div
                    class="p-6 border-b border-slate-100 dark:border-zinc-800 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white">Recently Registered Students</h3>
                        <p class="text-xs text-slate-500 dark:text-zinc-400 mt-0.5">A list of the latest students
                            enrolled in the system.</p>
                    </div>
                    <a href="{{ route('students.index') }}"
                        class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
                        View All
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600 dark:text-zinc-300">
                        <thead
                            class="bg-slate-50 dark:bg-zinc-800/50 text-xs font-semibold text-slate-500 dark:text-zinc-400 uppercase tracking-wider border-b border-slate-100 dark:border-zinc-800">
                            <tr>
                                <th scope="col" class="px-6 py-3.5">Reg No</th>
                                <th scope="col" class="px-6 py-3.5">Name</th>
                                <th scope="col" class="px-6 py-3.5">Email</th>
                                <th scope="col" class="px-6 py-3.5">Course</th>
                                <th scope="col" class="px-6 py-3.5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-zinc-800/60">
                            @forelse ($recentStudents as $student)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-zinc-800/30 transition">
                                <td class="px-6 py-4 font-mono font-medium text-slate-900 dark:text-white">
                                    {{ $student->reg_no }}</td>
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                    {{ $student->first_name }} {{ $student->last_name }}</td>
                                <td class="px-6 py-4 text-slate-500 dark:text-zinc-400">{{ $student->email }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 dark:bg-indigo-950/60 dark:text-indigo-300">
                                        {{ $student->course->course_name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('students.show', $student->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium text-xs">View</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400 dark:text-zinc-500">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <svg class="w-8 h-8 text-slate-300 dark:text-zinc-600" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <span class="text-sm font-medium">No recent students found.</span>
                                        <a href="{{ route('students.create') }}"
                                            class="text-xs text-indigo-600 dark:text-indigo-400 font-semibold hover:underline mt-1">
                                            Click here to add your first student
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>