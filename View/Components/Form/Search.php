<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Form;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class Search extends Component
{
    public ?string $type;
    public array $qs = [];

    public array $attrs = [];

    public array $form_attrs = ['method' => 'get'];

    public function __construct(string $type = 'v1')
    {
        $this->type = $type;

        /**
         * @var array
         */
        $query = request()->query();

        $this->qs = collect($query)
            ->except(['q'])
            ->all();

        switch ($type) {
            case 'inline':
                $this->form_attrs['class'] = 'd-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-right';
                break;
        }
    }

    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.form.search.'.$this->type;

        $view_params = [];

        return view()->make($view, $view_params);
    }
}
