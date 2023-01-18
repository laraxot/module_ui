<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class Button extends Component
{
    public string $type;

    public array $attrs;

    /**
     * Create the component instance.
     *
     * @return void
     */
    public function __construct(string $type = 'v1', array $attrs = [])
    {
        $this->type = $type;
        $this->attrs = $attrs;
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.button.'.$this->type;

        $view_params = ['view' => $view];

        return view()->make($view, $view_params);
    }
}
