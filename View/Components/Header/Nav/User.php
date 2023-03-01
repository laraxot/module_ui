<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Header\Nav;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

/**
 * Class Nav.
 */
class User extends Component {
    public array $attrs = [];
    public string $tpl;

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
        $tpl = (Auth::guest() ? 'guest' : 'logged').'.'.$this->tpl;
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($tpl);

        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
