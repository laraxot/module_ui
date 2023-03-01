<?php

declare(strict_types=1);

namespace Modules\UI\Http\Livewire\Input\Group;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

/**
 * Class Arr // Array is reserved.
 */
class Arr extends Component
{
    public string $type;
    public string $name;
    public array $form_data;
    public string $group;
    public string $email;

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function mount(string $type, string $name/* , string $group */)
    {
        $this->type = $type;
        $this->name = $name;
        $data = request()->all();
        $this->form_data = $data;
        $this->form_data[$this->name] = [];
        $this->group = '';
        $this->email = '';
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::livewire.input.group.arr.'.$this->type;
        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }

    public function addGroup(): void
    {
        // $this->form_data[$this->name] =

        $this->form_data[$this->name][$this->group] = [];
        $this->group = '';

        // dddx($this->form_data);
    }

    public function addMail(): void
    {
        $this->form_data[$this->name][$this->group][] = $this->email;
        $this->email = '';
    }

    public function getData(): void
    {
        dddx($this->form_data);
    }
}
