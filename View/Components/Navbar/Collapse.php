<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Navbar;

// use Harimayco\Menu\Facades\Menu;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

/**
 * Class Collapse.
 */
class Collapse extends Component
{
    public array $attrs = [];
    public array $menus = [];

    public string $menu_name;
    public string $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $menuName, string $type = 'v1')
    {
        // $this->menus = Menu::getByName($menuName);
        $this->menu_name = $menuName;
        $this->menus = [];
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.navbar.collapse.'.$this->type;

        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
