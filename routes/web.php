<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\HomeController;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('courses', CourseController::class)->only(['index', 'show']);

Route::get('my-courses', [EnrollmentController::class, 'myCourses'])->name('enroll.myCourses')->middleware('auth');

Route::get('enroll/{course}', [EnrollmentController::class, 'create'])->name('enroll.create');
Route::get('enroll/login/{course}', [EnrollmentController::class, 'handleLogin'])->name('enroll.handleLogin')->middleware('auth');
Route::post('enroll/{course}', [EnrollmentController::class, 'store'])->name('enroll.store');



require __DIR__.'/auth.php';


