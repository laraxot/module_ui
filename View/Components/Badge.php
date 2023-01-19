<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class Badge extends Component
{
    public string $type;

    public array $attrs = [];

    public function __construct(string $type = 'v1')
    {
        $this->type = $type;
    }

    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.badge.'.$this->type;

        $view_params = [];

        return view()->make($view, $view_params);
    }
}
