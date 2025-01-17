<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AdminController;
use App\Http\Controllers\User\TeacherController;
use App\Http\Controllers\User\StudentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['middleware' => ['auth']], function() {
    Route::prefix('admin')->name('admin.')->group(function() {
        Route::get('/users', [UserController::class, 'index'])->name('manage.users');
        Route::post('/users', [UserController::class, 'store'])->name('manage.users.store');
        Route::get('/users/{user}', [UserController::class, 'edit'])->name('manage.users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('manage.users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('manage.users.destroy');
        Route::post('assign/teacher/{course:uuid}', [UserController::class, 'assignTeacherToCourse'])->name('assign.teacher');

        Route::get('manage/roles',[RoleController::class, 'index'])->name('manage.roles');
        Route::put('manage/roles',[RoleController::class, 'update'])->name('manage.roles.update');
    });

    Route::prefix('teacher')->name('teacher.')->group(function() {
        Route::get('/courses', [TeacherController::class, 'index'])->name('manage.courses');
        Route::post('/courses', [TeacherController::class, 'storeCourse'])->name('manage.courses.store');
        Route::put('/courses', [TeacherController::class, 'editCourse'])->name('manage.courses.edit');
        Route::delete('/courses/{course:uuid}', [TeacherController::class, 'destroyCourse'])->name('manage.courses.destroy');
    });

    Route::prefix('student')->name('student.')->group(function() {
        Route::post('enroll/course/{course:uuid}', [StudentController::class, 'enrollCourse'])->name('enroll.course');
        Route::post('complete/lesson/{lesson:uuid}', [StudentController::class, 'completeLesson'])->name('complete.lesson');
        Route::post('take/test/{test:uuid}', [StudentController::class, 'takeTest'])->name('take.test');
    });
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
