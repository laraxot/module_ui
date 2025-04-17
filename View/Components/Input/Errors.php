<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Input;

use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;
use Illuminate\Contracts\Support\Renderable;

/**
 * Undocumented class.
 */
class Errors extends Component {
    public string $tpl;

    /**
     * Undocumented function.
     */
    public function __construct(string $tpl = 'v1') {
        $this->tpl = $tpl;
    }

    /**
     * Get the view / contents that represents the component.
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
