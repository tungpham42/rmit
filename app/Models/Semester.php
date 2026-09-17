<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $primaryKey = 'semester_id';

    protected $fillable = [
        'semester_code',
        'semester_start_date',
        'semester_end_date',
        'semester_current',
    ];

    protected $casts = [
        'semester_start_date' => 'datetime',
        'semester_end_date' => 'datetime',
        'semester_current' => 'boolean',
    ];
}
