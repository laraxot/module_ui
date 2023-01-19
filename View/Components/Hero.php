<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\UI\Services\ThemeService;

/**
 * Class Hero.
 */
class Hero extends Component
{
    public ?string $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $type = 'hero')
    {
        $this->type = $type;
        // ThemeService::make()->add('ui::View/Components/Card/rows.scss');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.hero.'.$this->type;
        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }
}
