<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;

class Card extends Component {
    public string $tpl; // = 'card';

    public array $attrs = [];

    public function __construct(string $tpl = 'card') {
        $this->tpl = $tpl;
    }

    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        // $view = 'ui::components.card.'.$this->type;
        $view = app(GetViewAction::class)->execute($this->tpl);

        $view_params = [];

        return view($view, $view_params);
    }
}
