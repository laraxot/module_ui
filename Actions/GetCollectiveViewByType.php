<?php

declare(strict_types=1);

namespace Modules\UI\Actions;

use Spatie\QueueableAction\QueueableAction;

class GetCollectiveViewByType {
    use QueueableAction;

    public function execute(string $type): string {
        // $json=__DIR__.'/_components.json';
        $coll = app(GetCollectiveComponents::class)->execute();
        $res = collect($coll)->firstWhere('name', 'bs'.$type);
        if (null == $res) {
            throw new \Exception('['.__LINE__.']['.__FILE__.']');
        }

        return $res->view;
    }
}
