<?php

declare(strict_types=1);

namespace Modules\UI\Actions;

use Spatie\LivewireWizard\Support\State;
use Spatie\QueueableAction\QueueableAction;

class GetStateDataAction
{
    use QueueableAction;

    // public function execute(State $state): array
    // {
    //     $data = collect();
    //     foreach (collect($state->all())->reverse() as $v) {
    //         $data = $data->merge($v['form_data']);
    //     }

    //     return $data->all();
    // }

    public function execute(State $state): array
    {
        $data = collect();
        foreach (collect($state->all())->reverse() as $v) {
            $data = $data->merge($v['form_data']);
        }

        if (0 == count($data->all())) {
            // dddx([
            //     $state->all(),
            //     $state->currentStep(),
            // ]);
        }

        return $data->all();
    }
}
