<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-xl sm:text-2xl text-slate-800 dark:text-zinc-100 leading-tight">
                    Grade Management
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-zinc-400 mt-1">
                    Manage student marks, grades, and academic performance.
                </p>
            </div>
            <a href="{{ route('grades.create') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs sm:text-sm font-semibold rounded-xl shadow-md transition">
                + Assign New Grade
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 dark:bg-zinc-950 min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
            <div
                class="p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl text-emerald-600 dark:text-emerald-400 text-sm font-medium">
                {{ session('success') }}
            </div>
            @endif

            <div
                class="bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr
                                class="bg-slate-50 dark:bg-zinc-800/50 border-b border-slate-200/80 dark:border-zinc-800 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-zinc-400">
                                <th class="p-4 sm:px-6">#</th>
                                <th class="p-4 sm:px-6">Student</th>
                                <th class="p-4 sm:px-6">Course</th>
                                <th class="p-4 sm:px-6">Score (%)</th>
                                <th class="p-4 sm:px-6">Grade</th>
                                <th class="p-4 sm:px-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody
                            class="divide-y divide-slate-100 dark:divide-zinc-800/60 text-slate-700 dark:text-zinc-300">
                            @forelse($grades as $grade)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-zinc-800/30 transition">
                                <td class="p-4 sm:px-6 font-medium text-slate-400">{{ $loop->iteration }}</td>
                                <td class="p-4 sm:px-6 font-bold text-slate-900 dark:text-white">
                                    {{ $grade->student->first_name ?? 'N/A' }} {{ $grade->student->last_name ?? '' }}
                                    <span
                                        class="block text-xs font-normal text-slate-400 dark:text-zinc-500">{{ $grade->student->reg_no ?? '' }}</span>
                                </td>
                                <td class="p-4 sm:px-6">
                                    {{ $grade->course->course_code ?? $grade->course->code ?? 'N/A' }}
                                </td>
                                <td class="p-4 sm:px-6 font-semibold">{{ $grade->score }}%</td>
                                <td class="p-4 sm:px-6">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold 
                                            {{ $grade->grade == 'A' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300' : '' }}
                                            {{ $grade->grade == 'B' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300' : '' }}
                                            {{ $grade->grade == 'C' ? 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300' : '' }}
                                            {{ $grade->grade == 'D' ? 'bg-orange-100 text-orange-800 dark:bg-orange-900/40 dark:text-orange-300' : '' }}
                                            {{ $grade->grade == 'F' ? 'bg-rose-100 text-rose-800 dark:bg-rose-900/40 dark:text-rose-300' : '' }}">
                                        {{ $grade->grade }}
                                    </span>
                                </td>
                                <td class="p-4 sm:px-6 text-right space-x-2">
                                    <a href="{{ route('grades.edit', $grade->id) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-slate-100 dark:bg-zinc-800 hover:bg-slate-200 dark:hover:bg-zinc-700 text-slate-700 dark:text-zinc-200 text-xs font-medium rounded-lg transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('grades.destroy', $grade->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this grade?')">
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
                                <td colspan="6" class="p-8 text-center text-slate-400 dark:text-zinc-500">
                                    No grades recorded yet. <a href="{{ route('grades.create') }}"
                                        class="text-indigo-600 dark:text-indigo-400 underline font-medium">Assign first
                                        grade</a>.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($grades->hasPages())
                <div class="p-4 border-t border-slate-100 dark:border-zinc-800">
                    {{ $grades->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>