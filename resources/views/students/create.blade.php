<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-xl sm:text-2xl text-slate-800 dark:text-zinc-100 leading-tight">
            Register New Student
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50 dark:bg-zinc-950 min-h-[calc(100vh-4rem)]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 rounded-2xl p-6 sm:p-8 shadow-sm">

                <form action="{{ route('students.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- 1. Select Registered User -->
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-slate-700 dark:text-zinc-300">
                            Select User Account
                        </label>
                        <select name="user_id" id="user_id" required onchange="autofillUserData(this)"
                            class="mt-1 block w-full rounded-xl border-slate-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            <option value="">-- Choose Registered User --</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" data-name="{{ $user->name }}"
                                data-email="{{ $user->email }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                            @endforeach
                        </select>
                        @error('user_id') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- 2. Registration Number -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-zinc-300">
                            Registration Number / Roll No
                        </label>
                        <input type="text" name="reg_no" value="{{ old('reg_no') }}" required
                            placeholder="e.g. REG/2026/001"
                            class="mt-1 block w-full rounded-xl border-slate-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('reg_no') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- 3. Names (Auto-filled or Manual) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-zinc-300">
                                First Name
                            </label>
                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
                                required
                                class="mt-1 block w-full rounded-xl border-slate-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            @error('first_name') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-zinc-300">
                                Last Name
                            </label>
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required
                                class="mt-1 block w-full rounded-xl border-slate-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            @error('last_name') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- 4. Email & Gender -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-zinc-300">
                                Email Address
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required readonly
                                class="mt-1 block w-full rounded-xl border-slate-300 dark:border-zinc-700 dark:bg-zinc-800/50 dark:text-zinc-400 bg-slate-100 shadow-sm text-sm cursor-not-allowed">
                            @error('email') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-zinc-300">
                                Gender
                            </label>
                            <select name="gender" required
                                class="mt-1 block w-full rounded-xl border-slate-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- 5. Assign Course -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-zinc-300">
                            Assign Course
                        </label>
                        <select name="course_id" required
                            class="mt-1 block w-full rounded-xl border-slate-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->course_code }} - {{ $course->course_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('course_id') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div
                        class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 dark:border-zinc-800">
                        <a href="{{ route('students.index') }}"
                            class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-zinc-400 hover:underline">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-md transition">
                            Save Student
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- JavaScript ya kujaza First Name, Last Name na Email pale User anapochaguliwa -->
    <script>
    function autofillUserData(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const fullName = selectedOption.getAttribute('data-name') || '';
        const email = selectedOption.getAttribute('data-email') || '';

        // Weka Email
        document.getElementById('email').value = email;

        // Tenganisha First Name na Last Name kutoka kwenye Jina la User
        if (fullName) {
            const nameParts = fullName.trim().split(' ');
            document.getElementById('first_name').value = nameParts[0] || '';
            document.getElementById('last_name').value = nameParts.slice(1).join(' ') || nameParts[0];
        } else {
            document.getElementById('first_name').value = '';
            document.getElementById('last_name').value = '';
        }
    }
    </script>
</x-app-layout>