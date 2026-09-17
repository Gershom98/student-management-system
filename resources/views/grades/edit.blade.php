<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-xl sm:text-2xl text-slate-800 dark:text-zinc-100 leading-tight">
                    Edit Grade
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-zinc-400 mt-1">
                    Update student marks and performance.
                </p>
            </div>
            <a href="{{ route('grades.index') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-slate-200 dark:bg-zinc-800 hover:bg-slate-300 dark:hover:bg-zinc-700 text-slate-700 dark:text-zinc-200 text-xs sm:text-sm font-semibold rounded-xl transition">
                &larr; Back to Grades
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 dark:bg-zinc-950 min-h-[calc(100vh-4rem)]">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 rounded-2xl p-6 sm:p-8 shadow-sm">

                <form action="{{ route('grades.update', $grade->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Select Student -->
                    <div>
                        <label for="student_id"
                            class="block text-sm font-medium text-slate-700 dark:text-zinc-300">Select Student</label>
                        <select name="student_id" id="student_id" required
                            class="mt-1 block w-full rounded-xl border-slate-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            @foreach($students as $student)
                            <option value="{{ $student->id }}"
                                {{ old('student_id', $grade->student_id) == $student->id ? 'selected' : '' }}>
                                {{ $student->first_name }} {{ $student->last_name }}
                                ({{ $student->reg_no ?? 'No Reg' }})
                            </option>
                            @endforeach
                        </select>
                        @error('student_id')
                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Select Course -->
                    <div>
                        <label for="course_id"
                            class="block text-sm font-medium text-slate-700 dark:text-zinc-300">Select Course</label>
                        <select name="course_id" id="course_id" required
                            class="mt-1 block w-full rounded-xl border-slate-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}"
                                {{ old('course_id', $grade->course_id) == $course->id ? 'selected' : '' }}>
                                {{ $course->course_code ?? $course->code }} -
                                {{ $course->course_name ?? $course->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('course_id')
                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Score -->
                    <div>
                        <label for="score" class="block text-sm font-medium text-slate-700 dark:text-zinc-300">Score
                            (%)</label>
                        <input type="number" step="0.01" min="0" max="100" name="score" id="score"
                            value="{{ old('score', $grade->score) }}" required
                            class="mt-1 block w-full rounded-xl border-slate-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('score')
                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Grade (Optional Override) -->
                    <div>
                        <label for="grade" class="block text-sm font-medium text-slate-700 dark:text-zinc-300">Grade
                            Letter</label>
                        <input type="text" name="grade" id="grade" value="{{ old('grade', $grade->grade) }}"
                            maxlength="5"
                            class="mt-1 block w-full rounded-xl border-slate-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('grade')
                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remarks -->
                    <div>
                        <label for="remarks"
                            class="block text-sm font-medium text-slate-700 dark:text-zinc-300">Remarks</label>
                        <input type="text" name="remarks" id="remarks" value="{{ old('remarks', $grade->remarks) }}"
                            class="mt-1 block w-full rounded-xl border-slate-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('remarks')
                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div
                        class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 dark:border-zinc-800">
                        <a href="{{ route('grades.index') }}"
                            class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-zinc-400 hover:underline">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-md transition">
                            Update Grade
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>