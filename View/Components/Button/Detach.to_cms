<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Button;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\Component;
use Modules\Cms\Contracts\PanelContract;

/**
 * Class Detach.
 */
class Detach extends Component
{
    public PanelContract $panel;
    public string $method = 'delete';
    public array $attrs = [];

    /**
     * Undocumented function.
     */
    public function __construct(PanelContract $panel, string $tpl = 'v1')
    {
        $this->tpl = $tpl;
        $this->panel = $panel;

        $this->attrs['class'] = [];

        if (inAdmin()) {
            $this->attrs['button']['class'] = config('adm_theme::styles.detach.button.class', 'btn btn-primary mb-2 btn-danger');
            $this->attrs['icon']['class'] = config('adm_theme::styles.detach.icon.class', 'fas fa-unlink');
        } else {
            $this->attrs['button']['class'] = config('pub_theme::styles.detach.button.class', 'btn btn-primary mb-2 btn-danger');
            $this->attrs['icon']['class'] = config('pub_theme::styles.detach.icon.class', 'fas fa-unlink');
        }
    }

    public function render(): View
    {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.button.detach.'.$this->tpl;
        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }

    public function shouldRender(): bool
    {
        if (! isset($this->panel->getRow()->pivot)) {
            return false;
        }

        return Gate::allows($this->method, $this->panel);
    }
}
