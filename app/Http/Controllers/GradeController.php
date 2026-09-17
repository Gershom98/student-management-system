<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    /**
     * Display a listing of grades/results for Admin and Teachers.
     */
    public function index()
    {
        $grades = Grade::with(['student', 'course'])->latest()->paginate(10);
        return view('grades.index', compact('grades'));
    }

    /**
     * Display academic summary for logged-in student (Student Portal View).
     */
    public function studentResults()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Tafuta student kwa kutumia email au user_id kama unayo relationship
        // Tumia trim() na strtolower() ili kuzuia matatizo ya herufi kubwa/ndogo na nafasi
        $student = Student::where('email', strtolower(trim($user->email)))->first();

        // Kama taarifa za mwanafunzi hazijatengenezwa kwenye table ya 'students'
        if (!$student) {
            $grades = collect();
            return view('students.results', compact('student', 'grades'))
                ->with('warning', 'Taarifa zako za mwanafunzi hazijapatikana kwenye mfumo bado.');
        }

        // 2. Vuta matokeo ya mwanafunzi huyu pekee
        $grades = Grade::with('course')
            ->where('student_id', $student->id)
            ->latest()
            ->get();

        return view('students.results', compact('student', 'grades'));
    }

    /**
     * Display academic summary / grade report.
     */
    public function report()
    {
        $totalGradesAssigned = Grade::count();
        $studentsWithGradesCount = Student::has('grades')->count();
        $averageScore = Grade::avg('score') ?? 0;

        $gradeCounts = [
            'A' => Grade::where('grade', 'A')->count(),
            'B' => Grade::where('grade', 'B')->count(),
            'C' => Grade::where('grade', 'C')->count(),
            'D' => Grade::where('grade', 'D')->count(),
            'F' => Grade::where('grade', 'F')->count(),
        ];

        return view('grades.report', compact(
            'totalGradesAssigned',
            'studentsWithGradesCount',
            'averageScore',
            'gradeCounts'
        ));
    }

    /**
     * Show the form for creating/assigning a new grade.
     */
    public function create()
    {
        $students = Student::all();
        $courses = Course::all();
        return view('grades.create', compact('students', 'courses'));
    }

    /**
     * Store a newly created grade in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id'  => 'required|exists:courses,id',
            'score'      => 'required|numeric|min:0|max:100',
            'grade'      => 'nullable|string|max:5',
            'remarks'    => 'nullable|string|max:255',
        ]);

        if (empty($validated['grade'])) {
            $validated['grade'] = $this->calculateGrade($validated['score']);
        }

        Grade::create($validated);

        return redirect()->route('grades.index')
            ->with('success', 'Grade assigned successfully.');
    }

    /**
     * Display the specified grade details.
     */
    public function show(Grade $grade)
    {
        $grade->load(['student', 'course']);
        return view('grades.show', compact('grade'));
    }

    /**
     * Show the form for editing the specified grade.
     */
    public function edit(Grade $grade)
    {
        $students = Student::all();
        $courses = Course::all();
        return view('grades.edit', compact('grade', 'students', 'courses'));
    }

    /**
     * Update the specified grade in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id'  => 'required|exists:courses,id',
            'score'      => 'required|numeric|min:0|max:100',
            'grade'      => 'nullable|string|max:5',
            'remarks'    => 'nullable|string|max:255',
        ]);

        if (empty($validated['grade'])) {
            $validated['grade'] = $this->calculateGrade($validated['score']);
        }

        $grade->update($validated);

        return redirect()->route('grades.index')
            ->with('success', 'Grade updated successfully.');
    }

    /**
     * Remove the specified grade from storage.
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();

        return redirect()->route('grades.index')
            ->with('success', 'Grade deleted successfully.');
    }

    /**
     * Helper method to calculate letter grade based on score.
     */
    private function calculateGrade($score)
    {
        if ($score >= 80) return 'A';
        if ($score >= 70) return 'B';
        if ($score >= 60) return 'C';
        if ($score >= 50) return 'D';
        return 'F';
    }
}