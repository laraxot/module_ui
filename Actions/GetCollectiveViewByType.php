<?php

declare(strict_types=1);

namespace Modules\UI\Actions;

use Spatie\QueueableAction\QueueableAction;

class GetCollectiveViewByType {
    use QueueableAction;

    public function execute(string $type): string {
        // $json=__DIR__.'/_components.json';

        // date.datetime.range
        // bsDateDatetimeRange

        if (count(explode('.', $type)) > 0) {
            $tmp = '';
            foreach (explode('.', $type) as $t) {
                $tmp .= ucfirst($t);
            }
            $type = $tmp;
        }

        $coll = app(GetCollectiveComponents::class)->execute();

        $res = collect($coll)->firstWhere('name', 'bs'.ucfirst($type));

        if (null == $res) {
            // dddx([$type, 'bs'.ucfirst($type), collect($coll)->firstWhere('name', 'bs'.ucfirst($type))]);
            throw new \Exception('['.$type.']['.__LINE__.']['.__FILE__.']');
        }

        return $res->view;
    }
}
