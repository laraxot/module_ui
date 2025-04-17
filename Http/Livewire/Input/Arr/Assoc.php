<?php

declare(strict_types=1);

namespace Modules\UI\Http\Livewire\Input\Arr;

use Livewire\Component;
use Modules\Cms\Actions\GetViewAction;
use Illuminate\Contracts\Support\Renderable;

/**
 * Class Arr // Array is reserved.
 */
class Assoc extends Component {
    public string $tpl;
    public string $name;
    public string $label;
    public array $form_data;
    // public array $value = [];

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function mount(string $name, string $label = '', array $value = [], string $tpl = 'v1') {
        $this->name = $name;
        $this->label = $label;
        // $this->value = $value ?? [];
        $this->tpl = $tpl;

        $res = [];
        foreach ($value as $k => $v) {
            $res[] = ['k' => $k, 'v' => $v];
        }

        $this->form_data[$this->name] = $res;
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

        return view($view, $view_params);
    }

    public function addArr(): void {
        $this->form_data[$this->name][] = ['k' => '', 'v' => ''];
    }

    public function subArr(string $id): void {
        unset($this->form_data[$this->name][$id]);
    }
}
