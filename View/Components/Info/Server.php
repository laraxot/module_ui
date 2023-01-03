<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Info;

use Illuminate\View\Component;
use Illuminate\Contracts\Support\Renderable;
use Modules\UI\Actions\GetServerMemoryUsage;

/**
 * Class Server.
 */
class Server extends Component {
    public array $attrs = [];
    public string $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $type = 'v1') {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.info.server.'.$this->type;
        $info= app(GetServerMemoryUsage::class)->execute();
        
        $view_params = [
            'view' => $view,
            'info' => $info,
        ];

        return view($view, $view_params);
    }
}
