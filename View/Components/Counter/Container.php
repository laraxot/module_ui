<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Counter;

use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;
use Illuminate\Contracts\Support\Renderable;

/**
 * Class Container.
 */
class Container extends Component {
    public ?string $img;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $img = 'pub_theme::img/src/banner-2.jpg', ?string $tpl = 'v1') {
        $this->img = $img;
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */

         //con getviewaction
        
        $view = app(GetViewAction::class)->execute($this->tpl);

        $view_params = [
            'img' => $this->img,
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
