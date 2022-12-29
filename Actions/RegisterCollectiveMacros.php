<?php

namespace Modules\UI\Actions;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Modules\Xot\Services\FileService;
use Collective\Html\FormFacade as Form;
use Spatie\QueueableAction\QueueableAction;


class RegisterCollectiveMacros {
    use QueueableAction;

    public function __construct(){

    }

    public function execute(string $macros_dir):void {
        $files = glob($macros_dir.'/*.php');
        //dddx(['dir'=>$macros_dir,'files'=>$files]);
        if (false === $files) {
            $files = [];
        }
        Collection::make($files)
            ->mapWithKeys(
                function ($path) {
                    if (false !== $path) {
                        return [$path => pathinfo($path, PATHINFO_FILENAME)];
                    }
                }
            )
            ->reject(
                function ($macro) {
                    return Collection::hasMacro($macro);
                }
            )
            ->each(
                function ($macro, $path): void {
                    $class = '\\Modules\\UI\\Macros\\'.$macro;
                    if ('BaseFormBtnMacro' !== $macro && \is_string($macro)) {
                        Form::macro('bs'.Str::studly($macro), app($class)());
                    }
                }
            );
    }
}