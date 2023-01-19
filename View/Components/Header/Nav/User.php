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
    public string $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $type = 'v1') {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.header.nav.user_';
        $view .= Auth::guest() ? 'guest' : 'logged';
        $view .= '.'.$this->type;

        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }
}
