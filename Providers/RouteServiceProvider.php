<?php

declare(strict_types=1);

namespace Modules\UI\Providers;

// --- bases ---
use Modules\Xot\Providers\XotBaseRouteServiceProvider;

/**
 * Class RouteServiceProvider.
 */
class RouteServiceProvider extends XotBaseRouteServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     */
    protected string $moduleNamespace = 'Modules\UI\Http\Controllers';

    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

    public function bootCallback(): void
    {
$router = app('router');
        //$router->aliasMiddleware('splade', \ProtoneMedia\Splade\Http\SpladeMiddleware::class);
    }
}
