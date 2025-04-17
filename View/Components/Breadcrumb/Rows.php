<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Breadcrumb;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;

/**
 * Class Rows.
 */
class Rows extends Component {
    public string $tpl;
    public Collection $rows;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $rows, string $tpl = 'rows') {
        $this->rows = $rows;
        $this->tpl = $tpl;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Renderable {
        $view = app(GetViewAction::class)->execute($this->tpl);
        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
