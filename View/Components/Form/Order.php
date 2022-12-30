<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Form;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;
use Modules\Cms\Services\PanelService;

class Order extends Component {
    public string $type;
    public array $qs;

    public array $options;
    public array $options1 = ['desc' => 'desc', 'asc' => 'asc'];
    public array $input_attrs = [];
    public array $form_attrs = ['method' => 'get'];

    public ?string $sort_by;
    public ?string $sort_order;

    public function __construct(string $type = 'v1') {
        $panel = PanelService::make()->getRequestPanel();
        $this->type = $type;
        $this->qs = collect(request()->query())
                    ->except(['sort'])
                    ->all();

        $this->options = array_combine($panel->orderBy(), $panel->orderBy());
        $this->input_attrs = ['placeholder' => 'Ordinamento', 'label' => ' '];
        switch ($type) {
            case 'inline':
                $this->form_attrs['class'] = 'd-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-right';
                break;
        }
        $this->sort_by = Request::input('sort.by');
        $this->sort_order = Request::input('sort.order');
    }

    // public function setSortOrderAttributes():array{
    //     return [
    //         'options' = ['desc' => 'desc', 'asc' => 'asc'],
    //         'attrs' = ['placeholder' => 'Ordinamento', 'label' => ' '],

    //     ];
    // }

    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.form.order.'.$this->type;

        $view_params = [];

        return view()->make($view, $view_params);
    }
}
