<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Progress;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

/**
 * Class Recover.
 */
class Bar extends Component {
    public float $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(float $value) {
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.progress.bar';
        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }
}
