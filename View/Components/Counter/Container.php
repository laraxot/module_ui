<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Counter;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;

/**
 * Class Container.
 */
class Container extends Component
{
    public ?string $img;
    public string $tpl;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $img = 'pub_theme::img/src/banner-2.jpg', string $tpl = 'v1')
    {
        $this->img = $img;
        $this->tpl = $tpl;
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);

        $view_params = [
            'img' => $this->img,
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
