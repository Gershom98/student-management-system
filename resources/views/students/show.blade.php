<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-xl sm:text-2xl text-slate-800 dark:text-zinc-100 leading-tight">
                    Student Profile
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-zinc-400 mt-1">
                    Viewing profile details and academic results for {{ $student->first_name }}
                    {{ $student->last_name }}.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('students.edit', $student->id) }}"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs sm:text-sm font-semibold rounded-xl transition shadow-sm">
                    Edit Profile
                </a>
                <a href="{{ route('students.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-slate-200 dark:bg-zinc-800 hover:bg-slate-300 dark:hover:bg-zinc-700 text-slate-700 dark:text-zinc-200 text-xs sm:text-sm font-semibold rounded-xl transition">
                    &larr; Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 dark:bg-zinc-950 min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Student Overview Card -->
            <div
                class="bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 rounded-2xl p-6 sm:p-8 shadow-sm">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-16 h-16 rounded-2xl bg-indigo-600/10 text-indigo-600 dark:bg-indigo-500/20 dark:text-indigo-400 flex items-center justify-center text-2xl font-black uppercase">
                            {{ substr($student->first_name ?? 'S', 0, 1) }}{{ substr($student->last_name ?? '', 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white">
                                {{ $student->first_name }} {{ $student->middle_name ?? '' }} {{ $student->last_name }}
                            </h3>
                            <p class="text-sm text-slate-500 dark:text-zinc-400 font-medium">
                                Reg No: <span
                                    class="text-indigo-600 dark:text-indigo-400 font-semibold">{{ $student->reg_no ?? $student->registration_number ?? 'N/A' }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8 pt-6 border-t border-slate-100 dark:border-zinc-800 text-sm">
                    <div>
                        <span class="block text-xs uppercase font-semibold text-slate-400 dark:text-zinc-500">Email
                            Address</span>
                        <span
                            class="font-medium text-slate-700 dark:text-zinc-200">{{ $student->email ?? 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="block text-xs uppercase font-semibold text-slate-400 dark:text-zinc-500">Phone
                            Number</span>
                        <span
                            class="font-medium text-slate-700 dark:text-zinc-200">{{ $student->phone ?? $student->phone_number ?? 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="block text-xs uppercase font-semibold text-slate-400 dark:text-zinc-500">Gender /
                            Status</span>
                        <span
                            class="font-medium text-slate-700 dark:text-zinc-200 uppercase">{{ $student->gender ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <!-- Grades / Results Table -->
            <div
                class="bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 rounded-2xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 dark:border-zinc-800">
                    <h4 class="font-bold text-slate-900 dark:text-white text-base">Academic Results</h4>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr
                                class="bg-slate-50 dark:bg-zinc-800/50 border-b border-slate-200/80 dark:border-zinc-800 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-zinc-400">
                                <th class="p-4 sm:px-6">Course Code</th>
                                <th class="p-4 sm:px-6">Course Name</th>
                                <th class="p-4 sm:px-6">Score (%)</th>
                                <th class="p-4 sm:px-6">Grade</th>
                                <th class="p-4 sm:px-6">Remarks</th>
                            </tr>
                        </thead>
                        <tbody
                            class="divide-y divide-slate-100 dark:divide-zinc-800/60 text-slate-700 dark:text-zinc-300">
                            @forelse($student->grades ?? [] as $grade)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-zinc-800/30 transition">
                                <td class="p-4 sm:px-6 font-semibold text-slate-900 dark:text-white">
                                    {{ $grade->course->course_code ?? $grade->course->code ?? 'N/A' }}
                                </td>
                                <td class="p-4 sm:px-6">
                                    {{ $grade->course->course_name ?? $grade->course->name ?? 'N/A' }}
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
                                <td class="p-4 sm:px-6 text-slate-500 dark:text-zinc-400">
                                    {{ $grade->remarks ?? '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-400 dark:text-zinc-500">
                                    No academic records found for this student.
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