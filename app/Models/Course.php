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
        'institution_id',
        'discipline_id'
    ];

    public function getPrice()
    {
        return $this->price ? '$'.number_format($this->price, 2) : 'FREE';
    }

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);

    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'course_id', 'user_id', 'enrollments')->using(Enrollment::class)->withPivot(['status_id']);
    }

    public function scopeSearchResults($query)
    {
        $query->when(request('discipline'), function($query) {
                $query->whereHas('discipline', function($query) {
                    $query->whereId(request('discipline'));
                });
            })
            ->when(request('institution'), function($query) {
                $query->whereHas('institution', function($query) {
                    $query->whereId(request('institution'));
                });
            });
    }
}
