<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Navbar;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;

/**
 * Item.
 */
class Item extends Component {
    public bool $active;
    public string $href;

    public function __construct(string $href, bool $active) {
        $this->href = $href;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute();
        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
