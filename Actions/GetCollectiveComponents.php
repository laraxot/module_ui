<?php

declare(strict_types=1);

namespace Modules\UI\Actions;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Xot\Services\FileService;
use Spatie\QueueableAction\QueueableAction;
use function Safe\json_decode;
use function Safe\json_encode;

class GetCollectiveComponents
{
    use QueueableAction;

    public function __construct()
    {
    }

    public function execute(string $view_path = '', string $prefix = ''): array
    {
        if ('' == $view_path && '' == $prefix) {
            $view_path = __DIR__ . '/../Resources/views/collective/fields';
            $prefix = 'ui::';
        }
        $components_json = $view_path . '/_components.json';
        $components_json = str_replace(['/', '\\'], [\DIRECTORY_SEPARATOR, \DIRECTORY_SEPARATOR], $components_json);

        $exists = File::exists($components_json);

        // if ($exists && ! $force_recreate) {
        if ($exists) {
            $content = File::get($components_json);
            /**
             * @var array
             */
            $json = json_decode($content);

            if (empty($json)) {
                return [];
            }

            return $json;
        }

        $comps = [];

        if (!$view_path) {
            throw new \Exception('$view_path is false');
        }

        $dirs = FileService::allDirectories($view_path, ['css', 'js']);
        $comps = collect($dirs)->map(
            function ($item) use ($prefix) {
                $ris = new \stdClass();
                $tmp = str_replace(\DIRECTORY_SEPARATOR, ' ', $item);
                $tmp_dot = str_replace(\DIRECTORY_SEPARATOR, '.', $item);
                $ris->name = 'bs' . Str::studly($tmp);
                $ris->view = $prefix . 'collective.fields.' . $tmp_dot . '.field';

                return $ris;
            }
        )->all();

        $content = json_encode($comps);
        if (!$content) {
            throw new \Exception('$content is false');
        }
        File::put($components_json, $content);

        return $comps;
    }
}
