<?php

declare(strict_types=1);

namespace Modules\UI\Http\Livewire\Input\Arr;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

/**
 * Class Arr // Array is reserved.
 */
class Assoc extends Component {
    public string $tpl;
    public string $name;
    public string $label;
    public array $form_data;
<<<<<<< HEAD
    // public array $value = [];
=======
    public array $value = [];

    public string $new_key = '';
    public string $new_value = '';
>>>>>>> f532fb8 (up)

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function mount(string $name, string $label = '', $value = null, string $tpl = 'v1') {
        $this->name = $name;
        $this->label = $label;
<<<<<<< HEAD
<<<<<<< HEAD
        // $this->value = $value ?? [];
        $this->tpl = $tpl;

        $res = [];
        foreach ($value as $k => $v) {
            $res[] = ['k' => $k, 'v' => $v];
        }

        $this->form_data[$this->name] = $res;
=======
        $this->value = $value;
        $this->tpl = $tpl;

        $this->form_data[$this->name] = $value;
>>>>>>> f532fb8 (up)
=======
        $this->value = $value ?? [];
        $this->tpl = $tpl;

        $res = [];
        foreach ($value as $k => $v) {
            $res[] = ['k' => $k, 'v' => $v];
        }

        $this->form_data[$this->name] = $res;
>>>>>>> c65baac (.)
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::livewire.input.arr.assoc.'.$this->tpl;
        $view_params = [
<<<<<<< HEAD
=======
            // ProfileService::make()->getProfile()->max_search_days
>>>>>>> f532fb8 (up)
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }

    public function addArr(): void {
<<<<<<< HEAD
        $this->form_data[$this->name][] = ['k' => '', 'v' => ''];
    }

    public function subArr(string $id): void {
        unset($this->form_data[$this->name][$id]);
=======
        // dddx($this->form_data);
        $this->form_data[$this->name][] = ['k' => '', 'v' => ''];
    }

    public function subArr(string $id): void {
        unset($this->form_data[$this->name][$id]);
    }

    public function updatedFormData(string $value, string $key): void {
        if (isset($this->model_id)) {
            $this->form_data['model_id'] = $this->model_id;
            $this->emit('updatedFormDataEvent', $this->form_data);
        }
    }

    public function set(string $value, string $key): void {
        $this->form_data[$key] = $value;
>>>>>>> f532fb8 (up)
    }
}
