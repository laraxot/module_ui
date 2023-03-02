<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;

/**
 * Class Col.
 */
class Col extends Component {
    public int $size;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $size) {
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Renderable {
        $view = app(GetViewAction::class)->execute();

        return view($view);
    }
}
