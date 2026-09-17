<?php

use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentVoteController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseEnrollmentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostFollowController;
use App\Http\Controllers\PostRateController;
use App\Http\Controllers\PostVoteController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserFollowController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    // Static/Specific routes MUST come before wildcard resource routes
    Route::get('semesters/current', [SemesterController::class, 'current'])->name('semesters.current');

    // Core Resources (Authorization enforced in FormRequests/Policies)
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('semesters', SemesterController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('courses', CourseController::class);
    Route::apiResource('posts', PostController::class);

    // Shallow Nested Comments
    Route::apiResource('posts.comments', CommentController::class)->shallow();

    // Post Interactions
    Route::prefix('posts/{post}')->name('posts.')->group(function () {
        Route::post('vote/like', [PostVoteController::class, 'like'])->name('vote.like');
        Route::post('vote/dislike', [PostVoteController::class, 'dislike'])->name('vote.dislike');
        Route::delete('vote', [PostVoteController::class, 'destroy'])->name('vote.destroy');

        Route::post('follow', [PostFollowController::class, 'store'])->name('follow.store');
        Route::delete('follow', [PostFollowController::class, 'destroy'])->name('follow.destroy');

        Route::post('rate', [PostRateController::class, 'store'])->name('rate.store');
        Route::delete('rate', [PostRateController::class, 'destroy'])->name('rate.destroy');
    });

    // Comment Interactions
    Route::prefix('comments/{comment}')->name('comments.')->group(function () {
        Route::post('vote/like', [CommentVoteController::class, 'like'])->name('vote.like');
        Route::post('vote/dislike', [CommentVoteController::class, 'dislike'])->name('vote.dislike');
        Route::delete('vote', [CommentVoteController::class, 'destroy'])->name('vote.destroy');
    });

    // User Interactions
    Route::prefix('users/{user}')->name('users.')->group(function () {
        Route::post('follow', [UserFollowController::class, 'store'])->name('follow.store');
        Route::delete('follow', [UserFollowController::class, 'destroy'])->name('follow.destroy');
    });

    // Course Enrollments
    Route::get('courses/{course}/students', [CourseEnrollmentController::class, 'index'])->name('courses.students.index');
    Route::post('courses/{course}/students/{user}', [CourseEnrollmentController::class, 'store'])->name('courses.students.store');
    Route::delete('courses/{course}/students/{user}', [CourseEnrollmentController::class, 'destroy'])->name('courses.students.destroy');
});
