<?php

declare(strict_types=1);

namespace Modules\UI\Actions;

use Spatie\QueueableAction\QueueableAction;

class GetViewAction {
    use QueueableAction;

    public function execute(): string {
        $backtrace = debug_backtrace();
        dddx($backtrace);

        return 'aaa';
    }
}