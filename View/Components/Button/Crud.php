<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Button;

use Illuminate\Contracts\View\View;
use Modules\Cms\Contracts\PanelContract;
use Modules\Xot\View\Components\XotBaseComponent;

/**
 * Class Crud.
 */
class Crud extends XotBaseComponent {
    public PanelContract $panel;
    // public bool $has_pivot;

    /**
     * Undocumented function.
     */
    public function __construct(PanelContract $panel) {
        $this->panel = $panel;
        // $this->has_pivot = isset($panel->getRow()->pivot);
    }

    /**
     * Undocumented function.
     */
    public function render(): View {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.button.crud';
        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }
}
