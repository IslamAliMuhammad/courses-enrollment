<?php

namespace App\Orchid\Resources;

use App\Models\Discipline;
use Orchid\Screen\TD;
use Orchid\Screen\Sight;
use Orchid\Crud\Resource;
use App\Models\Institution;
use Orchid\Screen\Fields\Input;

use function PHPSTORM_META\type;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;

class CourseResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Course::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('name')
            ->title('Name')
            ->placeholder('Enter name here')
            ->type('text')
            ->required(),
            TextArea::make('description')
            ->rows(5)
            ->placeholder('Enter description here')
            ->required(),
            Input::make('price')
            ->title('Price')
            ->placeholder('Enter price here')
            ->type('number')
            ->required(),
            Relation::make('institution_id')
            ->fromModel(Institution::class, 'name')
            ->title('Choose your institution'),
            Relation::make('discipline_id', 'discipline')
            ->fromModel(Discipline::class, 'name')
            ->title('Choose your disciplines'),
            Picture::make('image'),
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

            TD::make('name'),
            TD::make('description'),
            TD::make('price'),
            TD::make('institution_id', 'Institution')
                ->render(function ($course) {
                    return $course->institution->name;
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
            Sight::make('id'),
            Sight::make('name'),
            Sight::make('price'),
            Sight::make('institution_id', 'Institution')
                ->render(function ($course) {
                    return $course->institution->name;
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
        return ['institution'];
    }


    /**
     * Get the permission key for the resource.
     *
     * @return string|null
     */
    public static function permission(): ?string
    {
        return 'private-course-resource';
    }

}
