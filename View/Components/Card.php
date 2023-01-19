<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class Card extends Component
{
    public ?string $type = 'card';

    public array $attrs = [];

    public function __construct(?string $type = null)
    {
        $this->type = $type ?? 'card';
    }

    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.card.'.$this->type;

        $view_params = [];

        return view()->make($view, $view_params);
    }
}
