<?php

declare(strict_types=1);

namespace Modules\UI\View\Composers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Modules\UI\Models\Menu;
use Modules\Xot\Services\FileService;

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
    
    public function cssInLine(string $file): string {
        $content = File::get(FileService::assetPath($file));

        return $content;
    }
}