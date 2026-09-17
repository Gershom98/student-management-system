<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Academic Summary & Grade Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Overview Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Grades Assigned -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-indigo-500">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Grades Assigned</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalGradesAssigned }}</p>
                </div>

                <!-- Students Graded -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Students with Grades</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $studentsWithGradesCount }}</p>
                </div>

                <!-- Average Score -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Average System Score</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($averageScore, 1) }}%</p>
                </div>
            </div>

            <!-- Grade Breakdown / Distribution Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6 pb-2 border-b">
                    <h3 class="text-lg font-bold text-gray-800">
                        Grade Distribution Summary
                    </h3>
                    <a href="{{ route('grades.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Back to All Grades
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Grade</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Score Range</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total Count</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Percentage</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                            $ranges = [
                            'A' => '80% - 100%',
                            'B' => '70% - 79%',
                            'C' => '60% - 69%',
                            'D' => '50% - 59%',
                            'F' => 'Below 50%',
                            ];
                            @endphp

                            @foreach($gradeCounts as $grade => $count)
                            @php
                            $percentage = $totalGradesAssigned > 0 ? ($count / $totalGradesAssigned) * 100 : 0;
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($grade === 'A') bg-green-100 text-green-800 
                                            @elseif($grade === 'B') bg-blue-100 text-blue-800 
                                            @elseif($grade === 'C') bg-yellow-100 text-yellow-800 
                                            @elseif($grade === 'D') bg-orange-100 text-orange-800 
                                            @else bg-red-100 text-red-800 @endif">
                                        Grade {{ $grade }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $ranges[$grade] ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                    {{ $count }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <span class="mr-2">{{ number_format($percentage, 1) }}%</span>
                                        <div class="w-24 bg-gray-200 rounded-full h-2">
                                            <div class="bg-indigo-600 h-2 rounded-full"
                                                style="{{ 'width: ' . $percentage . '%;' }}"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>