<?php

declare(strict_types=1);

namespace Modules\UI\Actions;

use Modules\Xot\Services\FileService;
use Modules\UI\Datas\ServerMemoryUsageData;
use Spatie\QueueableAction\QueueableAction;

class GetServerMemoryUsage {
    use QueueableAction;

    public function __construct() {
    }

    public function execute(): ServerMemoryUsageData {
        /** @var int $memoryTotal */
        $memoryTotal = null;
        /** @var int $memoryTotal */
        $memoryFree = null;

        if (stristr(PHP_OS, 'win')) {
            // Get total physical memory (this is in bytes)
            $cmd = 'wmic ComputerSystem get TotalPhysicalMemory';
            @exec($cmd, $outputTotalPhysicalMemory);

            // Get free physical memory (this is in kibibytes!)
            $cmd = 'wmic OS get FreePhysicalMemory';
            @exec($cmd, $outputFreePhysicalMemory);

            if ($outputTotalPhysicalMemory && $outputFreePhysicalMemory) {
                // Find total value
                foreach ($outputTotalPhysicalMemory as $line) {
                    if ($line && preg_match('/^[0-9]+$/', $line)) {
                        $memoryTotal = $line;
                        break;
                    }
                }

                // Find free value
                foreach ($outputFreePhysicalMemory as $line) {
                    if ($line && preg_match('/^[0-9]+$/', $line)) {
                        $memoryFree = (int) $line;
                        $memoryFree *= 1024;  // convert from kibibytes to bytes
                        break;
                    }
                }
            }
        } else {
            if (is_readable('/proc/meminfo')) {
                $stats = @file_get_contents('/proc/meminfo');

                if (false !== $stats) {
                    // Separate lines
                    $stats = str_replace(["\r\n", "\n\r", "\r"], "\n", $stats);
                    $stats = explode("\n", $stats);

                    // Separate values and find correct lines for total and free mem
                    foreach ($stats as $statLine) {
                        $statLineData = explode(':', trim($statLine));

                        //
                        // Extract size (TODO: It seems that (at least) the two values for total and free memory have the unit "kB" always. Is this correct?
                        //

                        // Total memory
                        if (2 === \count($statLineData) && 'MemTotal' === trim($statLineData[0])) {
                            $memoryTotal = trim($statLineData[1]);
                            $memoryTotal = explode(' ', $memoryTotal);
                            $memoryTotal = (int) $memoryTotal[0];
                            $memoryTotal *= 1024;  // convert from kibibytes to bytes
                        }

                        // Free memory
                        if (2 === \count($statLineData) && 'MemFree' === trim($statLineData[0])) {
                            $memoryFree = trim($statLineData[1]);
                            $memoryFree = explode(' ', $memoryFree);
                            $memoryFree = (int) $memoryFree[0];
                            $memoryFree *= 1024;  // convert from kibibytes to bytes
                        }
                    }
                }
            }
        }

        if (null === $memoryTotal || null === $memoryFree) {
            throw new \Exception('Errore while getting memory data');
        }

        $usage = $memoryTotal - $memoryFree;

        return ServerMemoryUsageData::from([
            'total' => $memoryTotal,
            'total_nice' => FileService::getNiceFileSize((int) $memoryTotal),
            'usage' => $usage,
            'usage_nice' => FileService::getNiceFileSize((int) $usage),
            'free' => $memoryFree,
            'free_nice' => FileService::getNiceFileSize((int) $memoryFree),
            'perc' => round(100 - ($memoryFree * 100 / $memoryTotal), 2),
        ]);
    }
}
