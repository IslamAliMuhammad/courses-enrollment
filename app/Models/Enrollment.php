<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Enrollment extends Pivot
{
    //

    protected $fillable = [
        'user_id',
        'course_id',
        'enrollment_status_id',
    ];

    public function enrollmentStatus()
    {
        return $this->belongsTo(EnrollmentStatus::class);
    }
}
