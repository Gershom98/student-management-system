<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-xl sm:text-2xl text-slate-800 dark:text-zinc-100 leading-tight">
                    Course Management
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-zinc-400 mt-1">
                    Manage all available courses and view student enrollments.
                </p>
            </div>
            <a href="{{ route('courses.create') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs sm:text-sm font-semibold rounded-xl shadow-md transition">
                + Add New Course
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 dark:bg-zinc-950 min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Flash Session Alert -->
            @if(session('success'))
            <div
                class="p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl text-emerald-600 dark:text-emerald-400 text-sm font-medium">
                {{ session('success') }}
            </div>
            @endif

            <!-- Courses Table Card -->
            <div
                class="bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr
                                class="bg-slate-50 dark:bg-zinc-800/50 border-b border-slate-200/80 dark:border-zinc-800 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-zinc-400">
                                <th class="p-4 sm:px-6">#</th>
                                <th class="p-4 sm:px-6">Course Code</th>
                                <th class="p-4 sm:px-6">Course Name</th>
                                <th class="p-4 sm:px-6">Enrolled Students</th>
                                <th class="p-4 sm:px-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody
                            class="divide-y divide-slate-100 dark:divide-zinc-800/60 text-slate-700 dark:text-zinc-300">
                            @forelse($courses as $course)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-zinc-800/30 transition">
                                <td class="p-4 sm:px-6 font-medium text-slate-400">{{ $loop->iteration }}</td>
                                <td class="p-4 sm:px-6 font-bold text-slate-900 dark:text-white">
                                    {{ $course->course_code ?? $course->code }}
                                </td>
                                <td class="p-4 sm:px-6">{{ $course->course_name ?? $course->name }}</td>
                                <td class="p-4 sm:px-6">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300">
                                        {{ $course->students_count ?? $course->students->count() ?? 0 }} Students
                                    </span>
                                </td>
                                <td class="p-4 sm:px-6 text-right space-x-2">
                                    <a href="{{ route('courses.edit', $course->id) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-slate-100 dark:bg-zinc-800 hover:bg-slate-200 dark:hover:bg-zinc-700 text-slate-700 dark:text-zinc-200 text-xs font-medium rounded-lg transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this course?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 bg-rose-500/10 hover:bg-rose-500/20 text-rose-600 dark:text-rose-400 text-xs font-medium rounded-lg transition">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-400 dark:text-zinc-500">
                                    No courses found. <a href="{{ route('courses.create') }}"
                                        class="text-indigo-600 dark:text-indigo-400 underline font-medium">Create your
                                        first course</a>.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($courses->hasPages())
                <div class="p-4 border-t border-slate-100 dark:border-zinc-800">
                    {{ $courses->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>