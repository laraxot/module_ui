<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Form;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetStyleClassByViewAction;
use Modules\Cms\Actions\GetViewAction;
use Modules\Cms\Actions\GetViewThemeByViewAction;

class Search extends Component {
    public string $tpl;
    public array $qs = [];

    public array $attrs = [];

    public array $form_attrs = ['method' => 'get'];

    public string $view;

    public function __construct(string $tpl = 'v1') {
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
        // dddx([$this->attrs, $this->view]);
        // switch ($type) {
        //     case 'inline':
        //         $this->form_attrs['class'] = 'd-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-right';
        //         break;
        // }
    }

    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = $this->view;

        $view_params = [];

        return view($view, $view_params);
    }
}
