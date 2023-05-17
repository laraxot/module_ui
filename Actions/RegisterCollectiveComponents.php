<?php

declare(strict_types=1);

namespace Modules\UI\Actions;

use Collective\Html\FormFacade as Form;
use Modules\Xot\Services\FileService;
use Spatie\QueueableAction\QueueableAction;

class RegisterCollectiveComponents
{
    use QueueableAction;

    public function __construct()
    {
    }

    public function execute(string $path = '', string $prefix = ''): void
    {
        $blade_component_piece = 'collective.fields.group';
        if (\inAdmin()) {
            $blade_component = 'adm_theme::'.$blade_component_piece;
        } else {
            $blade_component = 'pub_theme::'.$blade_component_piece;
        }

        FileService::viewCopy('ui::'.$blade_component_piece, $blade_component);

        $comps = app(GetCollectiveComponents::class)->execute($path, $prefix);

        foreach ($comps as $comp) {
            Form::component(
                $comp->name,
                $comp->view,
                ['name', 'value' => null, 'attributes' => [],
                    'options' => [],
                    'comp_view' => $comp->view,
                    // 'comp_dir' => realpath($comp->dir),
                    'comp_ns' => implode('.', \array_slice(explode('.', $comp->view), 0, -1)),
                    'blade_component' => $blade_component, ]
            );
        }// end foreach
    }
}
