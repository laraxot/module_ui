<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;

/**
 * Class Pagination.
 */
class Pagination extends Component {
    public string $tpl;
    public LengthAwarePaginator $rows;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(LengthAwarePaginator $rows, string $tpl = 'v1') {
        $this->rows = $rows;
        $this->tpl = $tpl;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);
        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
