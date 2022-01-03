<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Attachment\Attachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    use AsSource, Filterable, Attachable;

    protected $fillable = [
        'name',
        'description',
        'price',
        'institution_id'
    ];

    public function desciplines()
    {
        return $this->belongsToMany(Discipline::class);

    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'course_id', 'user_id', 'enrollments')->using(Enrollment::class)->withPivot(['status_id']);
    }


}
