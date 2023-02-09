<?php

declare(strict_types=1);

namespace Modules\UI\Actions;

use Illuminate\Support\Str;
use Modules\Xot\Services\FileService;
use Spatie\QueueableAction\QueueableAction;

class GetViewAction {
    use QueueableAction;

    /**
     * PER ORA FUNZIONA SOLO CON LIVEWIRE.
     */
    public function execute(string $tpl = ''): string {
        $backtrace = debug_backtrace();
        $file0 = FileService::fixpath($backtrace[0]['file'] ?? '');
        $file0 = Str::after($file0, base_path());

        $arr = explode(DIRECTORY_SEPARATOR, $file0);

        if ('' == $arr[0]) {
            $arr = array_slice($arr, 1);
            $arr = array_values($arr);
        }

        $mod = $arr[1];
        $tmp = array_slice($arr, 3);

        $tmp = collect($tmp)->map(function ($item) {
            $item = str_replace('.php', '', $item);
            $item = Str::slug(Str::snake($item));

            return $item;
        })->implode('.');

        $view = Str::lower($mod).'::'.$tmp;
        if ('' != $tpl) {
            $tpl .= '.'.$tpl;
        }

        /*
        dddx([
            'file' => $file0,
            'mod' => $mod,
            'tmp' => $tmp,
            'view' => $view,
        ]);
        */
        if (! view()->exists($view)) {
            throw new \Exception('View ['.$view.'] not found');
        }

        return $view;
    }
}
