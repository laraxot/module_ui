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
        $items = $menu->items;
        if (null == $items) {
            return collect([]);
        }

        return $items;
    }

    public function cssInLine(string $file): string {
        $content = File::get(FileService::assetPath($file));

        return $content;
    }

    public function languages() {
        $langs = config('laravellocalization.supportedLocales');
        $langs = collect($langs)->map(
            function ($item, $k) {
                return [
                    'id' => $k,
                    'name' => $item['name'],
                ];
            }
        );

        return $langs;
    }

    public function otherLanguages() {
        $curr = app()->getLocale();
        $langs = $this->languages()
            ->filter(function ($item) use ($curr) {
                return $item['id'] != $curr;
            });

        return $langs;
    }

    public function currentLang(string $field) {
        $curr = app()->getLocale();
        $lang = $this->languages()->get($curr);

        return $lang[$field];
    }
}
