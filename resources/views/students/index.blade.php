<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-extrabold text-xl sm:text-2xl text-slate-800 dark:text-zinc-100 leading-tight">
                All Registered Students
            </h2>
            <a href="{{ route('students.create') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-md transition">
                + Add Student
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 dark:bg-zinc-950 min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
            <div
                class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 rounded-xl text-sm">
                {{ session('success') }}
            </div>
            @endif

            <div
                class="bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600 dark:text-zinc-300">
                        <thead
                            class="bg-slate-50 dark:bg-zinc-800/50 text-xs font-semibold text-slate-500 dark:text-zinc-400 uppercase tracking-wider border-b border-slate-100 dark:border-zinc-800">
                            <tr>
                                <th class="px-6 py-3.5">Reg No</th>
                                <th class="px-6 py-3.5">Full Name</th>
                                <th class="px-6 py-3.5">Email</th>
                                <th class="px-6 py-3.5">Gender</th>
                                <th class="px-6 py-3.5">Course</th>
                                <th class="px-6 py-3.5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-zinc-800/60">
                            @forelse($students as $student)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-zinc-800/30">
                                <td class="px-6 py-4 font-mono font-semibold text-slate-900 dark:text-white">
                                    {{ $student->reg_no }}</td>
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                    {{ $student->first_name }} {{ $student->last_name }}</td>
                                <td class="px-6 py-4">{{ $student->email }}</td>
                                <td class="px-6 py-4">{{ $student->gender }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 dark:bg-indigo-950/60 dark:text-indigo-300">
                                        {{ $student->course->course_name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right flex items-center justify-end gap-3">
                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-rose-600 hover:text-rose-800 text-xs font-semibold">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-400">No students registered
                                    yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-slate-100 dark:border-zinc-800">
                    {{ $students->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>