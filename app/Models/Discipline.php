<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Attachment\Attachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discipline extends Model
{
    use HasFactory;
    use AsSource, Filterable, Attachable;


    protected $fillable = [
        'name',
    ];


    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
