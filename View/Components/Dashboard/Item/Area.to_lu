<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Dashboard\Item;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\LU\Models\Area as ModelArea;
use Modules\Xot\Services\FileService;

// use Nwidart\Modules\Facades\Module;

// use Modules\Xot\View\Components\XotBaseComponent;

/**
 * Class Area.
 */
class Area extends Component
{
    public ModelArea $area;

    /**
     * Undocumented function.
     */
    public function __construct(ModelArea $area)
    {
        $this->area = $area;
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $area_define_name = $this->area->area_define_name;

        $ns = strtolower($area_define_name);

        /**
         * @phpstan-var view-string
         */
        $view = $ns.'::admin.dashboard.item';
        FileService::viewCopy('ui::admin.dashboard.item', $view);

        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }

    public function shouldRender(): bool
    {
        return true;
    }
}
