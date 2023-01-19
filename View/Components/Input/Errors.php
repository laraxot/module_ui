<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Input;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

/**
 * Undocumented class.
 */
class Errors extends Component
{
    public string $type;

    /**
     * Undocumented function.
     */
    public function __construct(string $type = 'v1')
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.input.errors.'.$this->type;
        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
