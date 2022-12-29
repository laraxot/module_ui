<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Header;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

/**
 * Class Nav.
 */
class Nav extends Component {
    public array $attrs = [];
    public string $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $type="v1") {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.header.nav.'.$this->type;

        $view_params = [
            'view' => $view,
            'search_action' => config('xra.search_action'),
            'logo' => config('metatag.logo_img'),
        ];

        return view($view, $view_params);
    }
}
