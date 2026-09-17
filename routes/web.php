<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guest & Authentication Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.attempt');

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('register.attempt');
});

/*
|--------------------------------------------------------------------------
| Public Feed & View Routes (No Auth Required)
|--------------------------------------------------------------------------
*/
// Main Feed (front.blade.php)
Route::get('/', function () {
    if (auth()->check() && auth()->user()->hasRole('admin')) {
        return redirect()->route('roles.index');
    }
    return app(PostController::class)->index(request());
})->name('home');

Route::get('/feed', [PostController::class, 'index'])->name('posts.index');

// Search (search.blade.php)
Route::get('/search', [PostController::class, 'search'])->name('search');

// Global Week Feed (week.blade.php)
Route::get('/weeks/{week}', [PostController::class, 'week'])->name('weeks.show');

// Profile Feeds (profile.blade.php & profile-follow.blade.php)
Route::prefix('profile/{user:name}')->name('profile.')->group(function () {
    Route::get('/', [PostController::class, 'profile'])->name('show');
    Route::get('/follows', [PostController::class, 'profileFollows'])->name('follows');
});

// Course Custom Feeds (course.blade.php & course-week.blade.php)
Route::prefix('courses/{course:code}')->name('courses.')->group(function () {
    Route::get('/', [PostController::class, 'course'])->name('show');
    Route::get('/weeks/{week}', [PostController::class, 'courseWeek'])->name('weeks.show');
});

// Single Post View (post.blade.php)
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');


/*
|--------------------------------------------------------------------------
| Authenticated Application Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Authenticated Post CRUD (create, store, edit, update, destroy)
    Route::resource('posts', PostController::class)->except(['index', 'show']);

    // Authenticated Course Actions (except the public show method)
    Route::resource('courses', CourseController::class)->except(['show']);

    // Shallow nested comments
    Route::resource('posts.comments', CommentController::class)->shallow();

    // Admin Only
    Route::middleware('role:admin')->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('semesters', SemesterController::class);
    });

    // Admin & Teacher
    Route::middleware('role:admin,teacher')->group(function () {
        Route::resource('users', UserController::class);
    });
});
