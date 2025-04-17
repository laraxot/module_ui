<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\Support\Renderable;
use Modules\Cms\Actions\GetViewAction;

/**
 * Class Debug.
 */
class Debug extends Component {
    public string $tpl;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $tpl='v1')    {
        $this->tpl=$tpl;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view=app(GetViewAction::class)->execute($this->tpl);
        $view_params=[
            'view'=>$view,
        ];
        return view($view,$view_params);
    }

    public function shouldRender(): bool
    {
        return false;
    }
}
