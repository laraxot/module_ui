<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Navbar;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetStyleClassByViewAction;
use Modules\Cms\Actions\GetViewAction;
use Modules\Cms\Actions\GetViewThemeByViewAction;

/**
 * Class Container.
 */
class Container extends Component {
    public ?string $tpl;
    public string $view;
    public array $attrs = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $tpl = 'v1') {
        $this->tpl = $tpl;

        $view = app(GetViewAction::class)->execute($this->tpl);
        $this->view = app(GetViewThemeByViewAction::class)->execute($view);
        $this->attrs['class'] = app(GetStyleClassByViewAction::class)->execute($this->view);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = $this->view;
        // dddx($view);
        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
