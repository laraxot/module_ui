<?php

declare(strict_types=1);

namespace Modules\UI\Http\Livewire\Input\StringList;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class Color extends Component {
    public string $name;
    public ?string $value;
    public array $form_data;

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function mount(string $name, ?string $value) {
        $this->name = $name;
        $this->value = $value;
        $this->form_data = explode(',', (string) $value);
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute();
        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }

    public function changeColor(): void {
        $this->value = implode(',', $this->form_data);
    }

    public function addColor(): void {
        $this->form_data[] = '#d60021';
        $this->changeColor();
    }

    public function deleteColor(int $k): void {
        unset($this->form_data[$k]);
        $this->changeColor();
    }
}
