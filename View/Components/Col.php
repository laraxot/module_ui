<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\View\Component;

/**
 * Class Col.
 */
class Col extends Component
{
    public int $size;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $size)
    {
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): \Illuminate\Contracts\Support\Renderable
    {
        return view()->make('ui::components.col');
    }
}
