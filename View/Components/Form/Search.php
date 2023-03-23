<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Form;

use Illuminate\View\Component;
use Modules\Blog\Models\Category;
use Modules\Cms\Actions\GetViewAction;
use Illuminate\Contracts\Support\Renderable;
use Modules\Cms\Actions\GetViewThemeByViewAction;
use Modules\Cms\Actions\GetStyleClassByViewAction;

class Search extends Component
{
    public string $tpl;
    public array $qs = [];

    public array $attrs = [];

    public array $form_attrs = ['method' => 'get'];

    public string $view;

    public array $categories = [];

    public function __construct(string $tpl = 'v1')
    {
        $this->tpl = $tpl;

        /**
         * @var array
         */
        $query = request()->query();

        $this->qs = collect($query)
            ->except(['q'])
            ->all();

        $view = app(GetViewAction::class)->execute($this->tpl);
        $this->view = app(GetViewThemeByViewAction::class)->execute($view);
        $this->attrs['class'] = app(GetStyleClassByViewAction::class)->execute($this->view);

        //vedere come aggiustare meglio. l'ideale sarebbe che 
        //se il pannello avesse il suo file del form di ricerca prendesse quello in automatico
        //come fa anche sulle pagine di autenticazione
        if (str_contains(url()->current(), '/admin/pfed/it/companies')) {

            $this->categories = Category::ofType('company')->pluck('name', 'id')->all();
            $this->view = 'pfed::components.form.search.company';
        }
    }

    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = $this->view;

        $view_params = [];

        return view($view, $view_params);
    }
}
