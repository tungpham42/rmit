<?php

namespace App\Services;

use App\Models\Course;
use App\Models\User;

class CourseEnrollmentService
{
    public function enroll(Course $course, User $user): void
    {
        $course->students()->syncWithoutDetaching([$user->user_id]);
    }

    public function unenroll(Course $course, User $user): void
    {
        $course->students()->detach($user->user_id);
    }

    public function isEnrolled(Course $course, User $user): bool
    {
        return $course->students()->where('users.user_id', $user->user_id)->exists();
    }
}
