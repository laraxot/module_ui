<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Promo;

use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;

/**
 * Undocumented class.
 */
class CounterItem extends Component {
    public int $counter;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $counter) {
        $this->counter = $counter;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render() {
        $view = app(GetViewAction::class)->execute();
        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
