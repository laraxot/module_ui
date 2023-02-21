<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetStyleClassByViewAction;
use Modules\Cms\Actions\GetViewAction;

/**
 * Class Std.
 */
class Std extends Component {
    public string $tpl;
    public array $attrs = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $tpl = 'v1') {
        $this->tpl = $tpl;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        // $view = 'ui::components.std.'.$this->tpl;
        $view = app(GetViewAction::class)->execute($this->tpl);
        $this->attrs['class'] = app(GetStyleClassByViewAction::class)->execute($view);

        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
