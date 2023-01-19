<?php

declare(strict_types=1);

namespace Modules\UI\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class CreateThemeCommand.
 */
class CreateThemeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'theme:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a skeleton theme.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        if (\is_array($name)) {
            $name = implode(' ', $name);
        }
        if (null === $name) {
            throw new \Exception('name is missing');
        }
        // dd($name);
        $dir = public_path('themes/'.$name);
        if (File::exists($dir)) {
            $this->error("Theme [{$name}] already exist!");

            return;
        } else {
            $from = realpath(__DIR__.'/../Resources/views/skeleton');
            if (! $from) {
                throw new \Exception(' ['.$from.'] was not found');
            }
            File::copyDirectory($from, $dir);
        }
        $this->info($dir);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the Theme.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
