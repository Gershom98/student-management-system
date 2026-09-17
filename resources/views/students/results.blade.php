<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Academic Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Fomu ya Filter kwa ajili ya Admin / Manager / Teacher -->
            @if(auth()->user()->role !== 'student')
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <form method="GET" action="{{ route('student.results') }}"
                    class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">

                    <!-- Dropdown ya Wanafunzi -->
                    <div>
                        <label for="student_id" class="block text-sm font-medium text-gray-700 mb-1">Filter by
                            Student</label>
                        <select name="student_id" id="student_id"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">-- All Students --</option>
                            @foreach($students as $student)
                            <option value="{{ $student->id }}"
                                {{ request('student_id') == $student->id ? 'selected' : '' }}>
                                {{ $student->first_name }} {{ $student->last_name }}
                                ({{ $student->registration_number ?? $student->id }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dropdown ya Kozi -->
                    <div>
                        <label for="course_id" class="block text-sm font-medium text-gray-700 mb-1">Filter by
                            Course</label>
                        <select name="course_id" id="course_id"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">-- All Courses --</option>
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}"
                                {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->code ?? '' }} - {{ $course->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Button za Filter na Reset -->
                    <div class="flex space-x-2">
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700">
                            Filter Results
                        </button>
                        <a href="{{ route('student.results') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-md hover:bg-gray-300">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
            @endif

            <!-- Warning Message kama Taarifa hazipatikani -->
            @if(isset($warning))
            <div class="p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 rounded shadow-sm">
                {{ $warning }}
            </div>
            @endif

            <!-- Meza ya Kuonyesha Matokeo -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">My Course Grades</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                @if(auth()->user()->role !== 'student')
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                                @endif
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Course Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Score</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Grade</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($grades as $grade)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}
                                </td>
                                @if(auth()->user()->role !== 'student')
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                    {{ $grade->student->first_name ?? '' }} {{ $grade->student->last_name ?? '' }}
                                </td>
                                @endif
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $grade->course->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold">
                                    {{ $grade->score }}%
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <span class="px-2 py-1 text-xs font-bold rounded bg-indigo-100 text-indigo-800">
                                        {{ $grade->grade_letter ?? $grade->grade }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Hakuna matokeo yaliyopatikana kwa vigezo ulivyochagua.
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