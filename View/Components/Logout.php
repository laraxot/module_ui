<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

/**
 * Class Logout.
 */
class Logout extends Component {
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct() {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.logout';

        $view_params = [];

        return view()->make($view, $view_params);
    }
}
