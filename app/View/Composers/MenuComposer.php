<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Discipline;
use App\Models\Institution;
use App\Repositories\UserRepository;

class MenuComposer
{

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('menuDisciplines', Discipline::withCount('courses')->whereHas('courses')->pluck('name', 'id'));
        $view->with('menuInstitutions', Institution::withCount('courses')->whereHas('courses')->pluck('name', 'id'));
    }
}
