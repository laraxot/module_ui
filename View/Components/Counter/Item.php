<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Counter;

use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;
use Illuminate\Contracts\Support\Renderable;

/**
 * Class Item.
 */
class Item extends Component
{
    public ?string $number;
    public ?string $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $number = '197', ?string $title = 'Title', ?string $tpl = 'v1')
    {
        $this->number = $number;
        $this->title = $title;
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
            'number' => $this->number,
            'title' => $this->title,
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }
}
