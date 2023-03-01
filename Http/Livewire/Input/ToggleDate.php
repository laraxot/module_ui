<?php

declare(strict_types=1);

namespace Modules\UI\Http\Livewire\Input;

use Livewire\Component;
use Modules\Cms\Actions\GetViewAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Renderable;

/**
 * Class Field.
 */
class ToggleDate extends Component {
    public Model $model;
    public string $field;
    public bool $isActive;

    /**
     * Undocumented function.
     */
    public function mount(): void {
        // $this->model = $model;
        // $this->field = $field;
        $this->isActive = null !== $this->model->getAttribute($this->field);
    }

    /**
     * Undocumented function.
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

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function updating(string $field, mixed $value) {
        $val = $value ? now() : null;
        $this->model->setAttribute($this->field, $val);
        $this->model->save();
        $this->emit('updateField', $this->model->getKey(), $this->field, $val);
    }
}
