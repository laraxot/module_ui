<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Info;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;
use Modules\UI\Actions\GetServerMemoryUsage;

/**
 * Class Server.
 */
class Server extends Component {
    public array $attrs = [];
    public string $tpl;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $tpl = 'v1') {
        $this->tpl = $tpl;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);

        $info = app(GetServerMemoryUsage::class)->execute();

        $view_params = [
            'view' => $view,
            'info' => $info,
        ];

        return view($view, $view_params);
    }
}
