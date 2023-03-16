<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Table;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetStyleClassByViewAction;
use Modules\Cms\Actions\GetViewAction;

class Th extends Component {
    public string $name;
    public string $tpl;

    public string $url;
    public string $label;
    public string $icon;

    public function __construct(string $name,string $tpl = 'v1') {
        $this->name=$name;
        $this->tpl=$tpl;
        $icon='';
        if (request()->has('sort_by') && request()->input('sort_by') == $name) {
            $icon = ' <span class="fa fa-caret-'
                .(request()->input('sort_direction', 'asc') == 'asc' ? 'up' : 'down')
                .'"></span>';
        }

        $order = 'asc';
        if (request()->has('sort_direction')) {
            $order = (request()->input('sort_direction') == 'desc' ? 'asc' : 'desc');
        }

        $url = request()->fullUrlWithQuery([
            'sort_by'        => $name,
            'sort_direction' => $order,
            'filter'         => request('filter'),
            'limit'          => request('limit'),
        ]);

        $this->url=$url;
        $this->label=$name;
        $this->icon=$icon;
    }

    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view =  app(GetViewAction::class)->execute($this->tpl);

        $view_params = [];

        return view($view, $view_params);
    }
}