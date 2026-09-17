<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\User;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     */
    public function index()
    {
        $students = Student::with('course')->latest()->paginate(10);
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        // 1. Vuta ma-user wote waliopo kwenye mfumo
    $users = User::all();

    // 2. Vuta kozi zote ili zionekane kwenye dropdown
    $courses = Course::all();

    // 3. Pasa zote mbili (users na courses) kwenda kwenye view
    return view('students.create', compact('users', 'courses'));
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reg_no'     => 'required|string|max:50|unique:students,reg_no',
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|max:150|unique:students,email',
            'gender'     => 'required|in:Male,Female',
            'course_id'  => 'required|exists:courses,id',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student registered successfully.');
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        $student->load('course');
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        // Muhimu: Vuta kozi zote pia hapa kwa ajili ya edit dropdown
        $courses = Course::all();
        return view('students.edit', compact('student', 'courses'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'reg_no'     => 'required|string|max:50|unique:students,reg_no,' . $student->id,
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|max:150|unique:students,email,' . $student->id,
            'gender'     => 'required|in:Male,Female',
            'course_id'  => 'required|exists:courses,id',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }
}