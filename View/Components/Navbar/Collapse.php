<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Navbar;

// use Harimayco\Menu\Facades\Menu;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;

/**
 * Class Collapse.
 */
class Collapse extends Component {
    public array $attrs = [];
    public array $menus = [];

    public string $menu_name;
    public string $tpl;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $menuName, string $tpl = 'v1') {
        // $this->menus = Menu::getByName($menuName);
        $this->menu_name = $menuName;
        $this->menus = [];
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
