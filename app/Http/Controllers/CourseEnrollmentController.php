<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Course;
use App\Models\User;
use App\Services\CourseEnrollmentService;

class CourseEnrollmentController extends Controller
{
    public function __construct(private readonly CourseEnrollmentService $enrollments)
    {
    }

    public function index(Course $course)
    {
        return UserResource::collection($course->students);
    }

    public function store(Course $course, User $user)
    {
        $this->enrollments->enroll($course, $user);

        return $this->noContent();
    }

    public function destroy(Course $course, User $user)
    {
        $this->enrollments->unenroll($course, $user);

        return $this->noContent();
    }
}
