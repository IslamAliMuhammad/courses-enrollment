<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollmentStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];


    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
