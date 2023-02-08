<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

/**
 * Class Std.
 */
class Topbar extends Component {
    public string $tpl;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $tpl = 'v2')
    {
        $this->tpl = $tpl;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.topbar.'.$this->tpl;
        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }
}
