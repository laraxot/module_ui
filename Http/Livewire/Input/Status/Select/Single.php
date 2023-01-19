<?php

declare(strict_types=1);

namespace Modules\UI\Http\Livewire\Input\Status\Select;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Modules\Xot\Contracts\ModelWithStatusContract;

/**
 * Class Single.
 * https://github.com/spatie/laravel-model-status.
 */
class Single extends Component
{
    public string $modelClass;
    public mixed $modelId;
    public array $options;
    public string $status = '';

    public ModelWithStatusContract $model;

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function mount(ModelWithStatusContract $model, array $options)
    {
        $this->model = $model;

        $this->modelClass = \get_class($model);
        $this->modelId = $model->getKey();

        $this->options = $options;
        if (property_exists($model, 'status')) {
            $this->status = $model->status;
        }

        // dddx($model->status);
    }

    public function changeStatus(): void
    {
        if ('' !== $this->status) {
            if (null !== $this->model->status()) {
                $this->model->status()->delete();
            }
            $this->model->setStatus($this->status);
            session()->flash('message', 'Status Changed');
        }

        if ('' === $this->status) {
            $status = $this->model->status();
            if (null !== $status) {
                $status->delete(); // returns the latest instance of `Spatie\ModelStatus\Status`
            }
            session()->flash('message', 'Status Removed');
        }
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::livewire.input.status.select.single';
        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }
}
