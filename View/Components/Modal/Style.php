<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Modal;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;

class Style extends Component {
    public string $tpl;

    public array $attrs = [];

    public function __construct(string $tpl = 'v1') {
        $this->tpl = $tpl;
    }

    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);

        $view_params = [];

        return view($view, $view_params);
    }
}
