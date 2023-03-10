<?php

declare(strict_types=1);

namespace Modules\UI\Http\Livewire\Input\Group;

use Livewire\Component;
use Modules\Cms\Actions\GetViewAction;
use Illuminate\Contracts\Support\Renderable;

/**
 * Class Arr // Array is reserved.
 */
class Arr extends Component {
    public string $tpl;
    public string $name;
    public array $form_data;
    public string $group;
    public string $email;

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function mount( string $name/* , string $group */,string $tpl = 'v1') {
        $this->tpl = $tpl;
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

    public function addGroup(): void {
        // $this->form_data[$this->name] =

        $this->form_data[$this->name][$this->group] = [];
        $this->group = '';

        // dddx($this->form_data);
    }

    public function addMail(): void {
        $this->form_data[$this->name][$this->group][] = $this->email;
        $this->email = '';
    }

    public function getData(): void {
        dddx($this->form_data);
    }
}
