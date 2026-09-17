<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-xl sm:text-2xl text-slate-800 dark:text-zinc-100 leading-tight">
                    Edit Student Information
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-zinc-400 mt-1">
                    Update profile and course enrollment details for {{ $student->first_name }}
                    {{ $student->last_name }}.
                </p>
            </div>
            <a href="{{ route('students.index') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-slate-200 dark:bg-zinc-800 hover:bg-slate-300 dark:hover:bg-zinc-700 text-slate-700 dark:text-zinc-200 text-xs sm:text-sm font-semibold rounded-xl transition">
                &larr; Back to Students List
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 dark:bg-zinc-950 min-h-[calc(100vh-4rem)]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 rounded-2xl p-6 sm:p-8 shadow-sm">

                <form action="{{ route('students.update', $student->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Registration Number -->
                    <div>
                        <label for="reg_no"
                            class="block text-sm font-medium text-slate-700 dark:text-zinc-300">Registration
                            Number</label>
                        <input type="text" name="reg_no" id="reg_no" value="{{ old('reg_no', $student->reg_no) }}"
                            required
                            class="mt-1 block w-full rounded-xl border-slate-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('reg_no')
                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Names (First & Last) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name"
                                class="block text-sm font-medium text-slate-700 dark:text-zinc-300">First Name</label>
                            <input type="text" name="first_name" id="first_name"
                                value="{{ old('first_name', $student->first_name) }}" required
                                class="mt-1 block w-full rounded-xl border-slate-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            @error('first_name')
                            <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                            @error
                        </div>

                        <div>
                            <label for="last_name"
                                class="block text-sm font-medium text-slate-700 dark:text-zinc-300">Last Name</label>
                            <input type="text" name="last_name" id="last_name"
                                value="{{ old('last_name', $student->last_name) }}" required
                                class="mt-1 block w-full rounded-xl border-slate-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            @error('last_name')
                            <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Email & Gender -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 dark:text-zinc-300">Email
                                Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $student->email) }}"
                                required
                                class="mt-1 block w-full rounded-xl border-slate-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            @error('email')
                            <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="gender"
                                class="block text-sm font-medium text-slate-700 dark:text-zinc-300">Gender</label>
                            <select name="gender" id="gender" required
                                class="mt-1 block w-full rounded-xl border-slate-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>
                                    Male</option>
                                <option value="Female"
                                    {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')
                            <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Course Assignment -->
                    <div>
                        <label for="course_id"
                            class="block text-sm font-medium text-slate-700 dark:text-zinc-300">Assigned Course</label>
                        <select name="course_id" id="course_id" required
                            class="mt-1 block w-full rounded-xl border-slate-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}"
                                {{ old('course_id', $student->course_id) == $course->id ? 'selected' : '' }}>
                                {{ $course->course_code }} - {{ $course->course_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('course_id')
                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div
                        class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 dark:border-zinc-800">
                        <a href="{{ route('students.index') }}"
                            class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-zinc-400 hover:underline">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-md shadow-indigo-500/20 transition duration-150">
                            Update Changes
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>