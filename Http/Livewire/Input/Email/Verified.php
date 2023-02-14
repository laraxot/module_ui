<?php

declare(strict_types=1);

namespace Modules\UI\Http\Livewire\Input\Email;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Modules\Cms\Actions\GetViewAction;

/**
 * Class Arr // Array is reserved.
 */
class Verified extends Component {
    public array $form_data = [];

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function mount(string $tpl = 'v1') {
        $this->tpl = $tpl;
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);
        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }
}
