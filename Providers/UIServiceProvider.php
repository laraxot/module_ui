<?php

declare(strict_types=1);

namespace Modules\UI\Providers;

// ---- bases ----
use Illuminate\Foundation\AliasLoader;
use Illuminate\Pagination\Paginator;
// --- services ---
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use Modules\UI\Actions\RegisterCollectiveMacros;
use Modules\UI\Services\ThemeService;
use Modules\Xot\Datas\XotData;
use Modules\Xot\Providers\XotBaseServiceProvider;
use Modules\Xot\Services\BladeService;
use Modules\Xot\Services\FileService;

/**
 * Class UIServiceProvider.
 */
class UIServiceProvider extends XotBaseServiceProvider
{
    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

    public string $module_name = 'ui';

    public XotData $xot;

    /**
     * Undocumented function.
     */
    public function getXot(): XotData
    {
        return $this->xot;
    }

    /**
     * Undocumented function.
     */
    public function bootCallback(): void
    {
        if ($this->app->runningInConsole()) {
            $this->mergeConfigFrom(__DIR__.'/../Config/xra.php', 'xra');
        }

        $this->xot = XotData::make();

        $this->commands(
            [
                \Modules\UI\Console\Commands\CreateThemeCommand::class,
            ]
        );

        // BladeService::registerComponents($this->module_dir.'/../View/Components', 'Modules\\UI');
        if($this->xot->register_collective) {
            $this->registerCollective();
        }

        Paginator::useBootstrap();
    }

    public function registerCollective(): void
    {
        if(class_exists(\Collective\Html\FormFacade::class)) {
            app(\Modules\UI\Actions\RegisterCollectiveComponents::class)->execute(
                $this->module_dir.'/../Resources/views/collective/fields',
                $this->module_name.'::'
            );

            app(RegisterCollectiveMacros::class)->execute($this->module_dir.'/../Macros');
        }
    }

    /*
     * Undocumented function.
     *
     * @return void
     --- move to cms module
    public function bootThemeProvider(string $theme_type)
    {
        $theme = $this->xot->{$theme_type};

        //if (! File::exists(base_path('Themes/'.$theme))) {
        //    $xot[$theme_type] = ThemeService::firstThemeName($theme_type);
        //    TenantService::saveConfig('xra', $xot );
        //    throw new \Exception('['.base_path('Themes/'.$theme).' not exists]['.__LINE__.']['.class_basename(__CLASS__).']');
        //}

        $provider = 'Themes\\'.$theme.'\Providers\\'.$theme.'ServiceProvider';
        if (! class_exists($provider)) {
            throw new \Exception('class not exists ['.$provider.']['.__LINE__.']['.basename(__FILE__).']');
        }

        $provider = new $provider();

        if (method_exists($provider, 'bootCallback')) {
            $provider->bootCallback();
        }
    }
    */
    /**
     * Undocumented function.
     *
     * @return void
     */
    public function registerNamespaces(string $theme_type)
    {
        $theme = $this->xot->{$theme_type};

        $resource_path = 'Themes/'.$theme.'/Resources';
        $lang_dir = base_path($resource_path.'/lang');
        $lang_dir = FileService::fixPath($lang_dir);
        $theme_dir = base_path($resource_path.'/views');
        $theme_dir = FileService::fixPath($theme_dir);
        app('view')->addNamespace($theme_type, $theme_dir);
        $this->loadTranslationsFrom($lang_dir, $theme_type);
    }

    public function registerThemeConfig(string $theme_type): void
    {
        $theme = $this->xot->{$theme_type};

        $config_path = base_path('Themes/'.$theme.'/Config');
        if (! File::exists($config_path)) {
            return;
        }
        $files = File::files($config_path);
        foreach ($files as $file) {
            $name = $file->getFilenameWithoutExtension();
            $real_path = $file->getRealPath();
            if (false === $real_path) {
                throw new \Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
            }
            $data = File::getRequire($real_path);
            Config::set($theme_type.'::'.$name, $data);
        }
    }

    public function registerCallback(): void
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Theme', 'Modules\UI\Services\ThemeService');
    }
}
