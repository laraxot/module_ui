<?php

declare(strict_types=1);

namespace Modules\UI\Datas;

use Spatie\LaravelData\Data;

class ServerMemoryUsageData extends Data {
    public int $total; // 34199285760"
    public string $total_nice; // => "31.85 GiB"
    public int $usage; // " => 16192126976
    public string $usage_nice; // " => "15.08 GiB"
    public int $free; // " => 18007158784
    public string $free_nice; // " => "16.77 GiB"
    public float $perc;
}
