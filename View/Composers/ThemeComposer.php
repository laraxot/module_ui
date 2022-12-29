<?php

declare(strict_types=1);

namespace Modules\UI\View\Composers;

use Illuminate\Support\Collection;
use Modules\UI\Models\Menu;

/**
 * --.
 */
class ThemeComposer {
    public function getMenuItemsByName(string $name): Collection {
        $menu = Menu::firstWhere('name', $name);
        if (null === $menu) {
            return collect([]);
        }
        $rows = $menu->items;

        return $rows;
    }
}
