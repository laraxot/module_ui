<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Button;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Modules\Cms\Contracts\PanelContract;
use Modules\Xot\View\Components\XotBaseComponent;

/**
 * Class Edit.
 */
class Edit extends XotBaseComponent
{
    public PanelContract $panel;
    public string $method = 'edit';

    /**
     * Undocumented function.
     */
    public function __construct(PanelContract $panel)
    {
        $this->panel = $panel;
    }

    public function render(): View
    {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.button.edit';
        $view_params = [
            'view' => $view,
        ];
        // if (! Gate::allows($this->method, $this->panel)) {
        //    return null;
        // }

        return view()->make($view, $view_params);
    }

    public function shouldRender(): bool
    {
        return Gate::allows($this->method, $this->panel);
    }
}
