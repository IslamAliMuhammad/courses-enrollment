<?php

namespace App\Orchid\Resources;

use App\Models\User;
use Orchid\Screen\TD;
use App\Models\Course;
use App\Models\EnrollmentStatus;
use Orchid\Screen\Sight;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Relation;

class EnrollmentResource extends Resource
{



    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Enrollment::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Relation::make('user_id')
            ->fromModel(User::class, 'name')
            ->title('Choose user'),
            Relation::make('course_id')
            ->fromModel(Course::class, 'name')
            ->title('Choose course'),
            Relation::make('enrollment_status_id')
            ->fromModel(EnrollmentStatus::class, 'name')
            ->title('Choose status'),

        ];
    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id'),

            TD::make('user_id', 'User')
                ->render(function ($enrollment) {
                    return $enrollment->user->name;
                }),
            TD::make('course_id', 'Course')
                ->render(function ($enrollment) {
                    return $enrollment->course->name;
                }),
            TD::make('enrollment_status_id', 'Status')
            ->render(function ($enrollment) {
                return $enrollment->enrollmentStatus->name;
            }),
            TD::make('created_at', 'Date of creation')
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),

            TD::make('updated_at', 'Update date')
                ->render(function ($model) {
                    return $model->updated_at->toDateTimeString();
                }),
        ];
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [
            Sight::make('user_id', 'User')
                ->render(function ($enrollment) {
                    return $enrollment->user->name;
                }),
            Sight::make('course_id', 'Course')
                ->render(function ($enrollment) {
                    return $enrollment->course->name;
                }),
            Sight::make('enrollment_status_id', 'Status')
                ->render(function ($enrollment) {
                    return $enrollment->enrollmentStatus->name;
                }),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [];
    }

    /**
     * Get relationships that should be eager loaded when performing an index query.
     *
     * @return array
     */
    public function with(): array
    {
        return ['user', 'course', 'enrollmentStatus'];
    }

    /**
     * Get the permission key for the resource.
     *
     * @return string|null
     */
    public static function permission(): ?string
    {
        return 'private-enrollment-resource';
    }
}
