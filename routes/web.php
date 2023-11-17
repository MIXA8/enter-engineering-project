<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('teacher', TeacherController::class)->middleware(['auth', 'verified', 'directory']);


Route::resource('group', \App\Http\Controllers\Group\GroupController::class)->except('index')->middleware(
    ['auth', 'verified', 'directory']
);
Route::resource('group', \App\Http\Controllers\Group\GroupController::class)->only('index')->middleware(
    ['auth', 'verified', 'teacher']
);


Route::resource('student', StudentController::class)->except('index')->middleware(
    ['auth', 'verified', 'directory']
);
Route::resource('student', StudentController::class)->only('index')->middleware(
    ['auth', 'verified', 'teacher']
);


Route::resource('subject', \App\Http\Controllers\Subject\SubjectController::class)->except('index')->middleware(
    ['auth', 'verified', 'directory']
);
Route::resource('subject', \App\Http\Controllers\Subject\SubjectController::class)->only('index')->middleware(
    ['auth', 'verified', 'teacher']
);
Route::get('group/subject/student', [\App\Http\Controllers\Subject\SubjectController::class, 'indexForStudent']
)->middleware(
    ['auth', 'verified', 'studentId']
)->name('group.subject.student');


Route::resource('grade', \App\Http\Controllers\Grade\GradeController::class)->middleware(
    ['auth', 'verified', 'teacher']
);

Route::resource('directory', \App\Http\Controllers\Directory\DirectoryController::class)->middleware(
    ['auth', 'directory']
);


Route::get('grade/show/list', [\App\Http\Controllers\Grade\GradeController::class, 'gradeList'])->middleware(
    ['auth', 'verified']
)->name('grade.show.list');

Route::get('student/report/group/list', [ReportController::class, 'listGroup'])->middleware(
    ['auth', 'verified', 'teacher']
)->name(
    'student.report.group.list'
);

Route::get('student/report/student/list', [ReportController::class, 'listStudent'])->middleware(
    ['auth', 'verified', 'teacher']
)->name(
    'student.report.students.list'
);

Route::get('student/report/avg', [ReportController::class, 'reportAvg'])->middleware(['auth', 'verified', 'studentId']
)->name(
    'student.report.avg'
);

Route::get('student/report/avg/{id}', [ReportController::class, 'reportAvgStudent'])->middleware(
    ['auth', 'verified', 'studentId']
);


Route::get('group/report/avg', [ReportController::class, 'reportGroupAvg'])->middleware(['auth', 'verified', 'teacher']
)->name(
    'group.report.avg'
);

Route::get('group/report/avg/group/{id}', [ReportController::class, 'reportGroupAvgPrint'])->middleware(
    ['auth', 'verified', 'teacher']
);


require __DIR__ . '/auth.php';

