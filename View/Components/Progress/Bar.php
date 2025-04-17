<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Progress;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;

/**
 * Class Recover.
 */
class Bar extends Component {
    public float $value;
    public string $tpl;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(float $value, string $tpl = 'v1') {
        $this->tpl = $tpl;
        $this->value = $value;
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
