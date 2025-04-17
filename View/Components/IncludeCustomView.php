<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

/**
 * Undocumented class.
 */
class IncludeCustomView extends Component {
    public string $view;

    public function __construct(string $view) {
        $this->view = $view;
    }

    public function render(): Renderable {
        /**
         * @var string
         */
        $main_module = config('xra.main_module');
        /**
         * @phpstan-var view-string
         */
        $view = strtolower($main_module).'::'.$this->view;
        if (! View::exists($view)) {
            $view = 'ui::components.empty';
        }

        return view($view);
    }
}
