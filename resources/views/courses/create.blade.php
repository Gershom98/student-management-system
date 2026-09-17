<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-xl sm:text-2xl text-slate-800 dark:text-zinc-100 leading-tight">
                    Add New Course
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-zinc-400 mt-1">
                    Create a new academic course for student enrollment.
                </p>
            </div>
            <a href="{{ route('courses.index') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-slate-200 dark:bg-zinc-800 hover:bg-slate-300 dark:hover:bg-zinc-700 text-slate-700 dark:text-zinc-200 text-xs sm:text-sm font-semibold rounded-xl transition">
                &larr; Back to Courses
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 dark:bg-zinc-950 min-h-[calc(100vh-4rem)]">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 rounded-2xl p-6 sm:p-8 shadow-sm">

                <form action="{{ route('courses.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Course Code -->
                    <div>
                        <label for="course_code"
                            class="block text-sm font-medium text-slate-700 dark:text-zinc-300">Course Code</label>
                        <input type="text" name="course_code" id="course_code" value="{{ old('course_code') }}"
                            placeholder="e.g. BIT 101" required
                            class="mt-1 block w-full rounded-xl border-slate-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('course_code')
                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Course Name -->
                    <div>
                        <label for="course_name"
                            class="block text-sm font-medium text-slate-700 dark:text-zinc-300">Course Name</label>
                        <input type="text" name="course_name" id="course_name" value="{{ old('course_name') }}"
                            placeholder="e.g. Bachelor of Information Technology" required
                            class="mt-1 block w-full rounded-xl border-slate-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('course_name')
                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div
                        class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 dark:border-zinc-800">
                        <a href="{{ route('courses.index') }}"
                            class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-zinc-400 hover:underline">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-md transition">
                            Save Course
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>