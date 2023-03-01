<?php

declare(strict_types=1);

namespace Modules\UI\Http\Livewire\Input;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

/**
 * Class Arr // Array is reserved.
 */
class Arr extends Component
{
    public string $type;
    public string $name;
    public ?string $label;
    public array $form_data;
    public ?array $value = [];
    public ?int $model_id;

    /**
     * @var array<string, string>
     */
    protected $listeners = ['addArr' => 'addArr'];

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function mount(string $type, string $name, ?string $label, ?array $value, ?int $modelId = null)
    {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;

        $data = request()->all();

        // dddx($data);

        if (\is_array($value)) {
            // $data[$name] = array_merge($value, $data[$name] ?? []);
            // $data[$name] = array_merge($value[$name] ?? [], $data[$name] ?? []);
            $data = array_merge($data, $value);
        }
        if (isset($modelId)) {
            $data['rows'][$modelId] = $data;
        }

        $this->model_id = $modelId;

        $this->form_data = $data;
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::livewire.input.arr.'.$this->type;
        $view_params = [
            // ProfileService::make()->getProfile()->max_search_days
            'view' => $view,
        ];

        return view($view, $view_params);
    }

    public function addArr(): void
    {
        // dddx($this->form_data);
        $this->form_data[$this->name][] = null;
    }

    public function subArr(int $id): void
    {
        unset($this->form_data[$this->name][$id]);
        if (isset($this->model_id)) {
            $this->form_data['model_id'] = $this->model_id;
            $this->emit('updatedFormDataEvent', $this->form_data);
        }
    }

    public function updatedFormData(string $value, string $key): void
    {
        if (isset($this->model_id)) {
            $this->form_data['model_id'] = $this->model_id;
            $this->emit('updatedFormDataEvent', $this->form_data);
        }
    }

    public function set(string $value, string $key): void
    {
        $this->form_data[$key] = $value;
    }
}
