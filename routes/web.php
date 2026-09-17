<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GradeController;
use App\Models\Student;
use App\Models\Course;
use App\Models\Grade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Home Page
Route::get('/', function () {
    return view('welcome');
});

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {

    // 1. Dashboard Kuu (Inajiepusha kuonyesha Stats kwa Mwanafunzi)
    Route::get('/dashboard', function () {
        $user = Auth::User();

        // Kama ni mwanafunzi, mwelekeze moja kwa moja kwenye matokeo yake
        if ($user->role === 'student') {
            return redirect()->route('student.results');
        }

        // Kwa Admin na Teacher, vuta stats zote za mfumo
        $totalStudents = Student::count();
        $totalCourses  = Course::count();
        $totalGrades   = Grade::count();
        $recentStudents = Student::with('course')->latest()->take(5)->get();

        return view('dashboard', compact('totalStudents', 'totalCourses', 'totalGrades', 'recentStudents'));
    })->name('dashboard');

    // 2. Profile Routes (Zinatumika na watumiaji wote)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // -------------------------------------------------------------
    // ROUTES ZA MWANAFUNZI PEKEE (ROLE: STUDENT)
    // -------------------------------------------------------------
    Route::middleware(['role:student'])->group(function () {
        Route::get('/my-results', [GradeController::class, 'studentResults'])->name('student.results');
    });

    // -------------------------------------------------------------
    // ROUTES ZA UONGOZI / WALIMU (ROLE: ADMIN, TEACHER)
    // -------------------------------------------------------------
    Route::middleware(['role:admin,teacher'])->group(function () {
        
        // Management za Wanafunzi
        Route::resource('students', StudentController::class);

        // Management za Kozi
        Route::resource('courses', CourseController::class);

        // Management za Maksi na Ripoti za Jumla
        Route::get('/grades/report', [GradeController::class, 'report'])->name('grades.report');
        Route::resource('grades', GradeController::class);
    });

});

require __DIR__.'/auth.php';