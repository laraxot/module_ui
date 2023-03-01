<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Layout;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetStyleClassByViewAction;
use Modules\Cms\Actions\GetViewAction;

class Wizard extends Component {
    public string $tpl;
    public string $view;
    public array $attrs = [];

    public function __construct(string $tpl = 'v1') {
        $this->tpl = $tpl;

        $this->view = app(GetViewAction::class)->execute($this->tpl);
        // $this->attrs['class'] = app(GetStyleClassByViewAction::class)->execute($this->view);
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
