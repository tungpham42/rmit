<?php

namespace App\Enums;

/**
 * Canonical role identifiers. Use these instead of raw strings so typos
 * fail at compile time rather than silently letting a check through.
 */
enum RoleName: string
{
    case Admin = 'admin';
    case Teacher = 'teacher';
    case Student = 'student';

    /**
     * The role assigned to new self-registrations.
     */
    public static function default(): self
    {
        return self::Student;
    }
}
