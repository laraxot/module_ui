<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Table\Th;


use Illuminate\Support\Str;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;
use Illuminate\Contracts\Support\Renderable;
use Modules\Cms\Actions\GetStyleClassByViewAction;

class Spatie extends Component
{
    public string $name;
    public string $tpl;

    public string $url;
    public string $label;
    public string $icon;

    public function __construct(string $name, string $tpl = 'v1')
    {
        $this->name = $name;
        $this->tpl = $tpl;
        $icon = '';
        $sort = request('sort', '');
        $sort_by = $sort;
        $order = 'asc';
        if (Str::startsWith($sort_by, '-')) {
            $sort_by = Str::after($sort_by, '-');
            $order = 'desc';
            $sort = $name;
        } else {
            $sort = '-' . $name;
        }
        if ($sort_by == $name) {

            $icon = ' <span class="fa fa-caret-'
                . ($order == 'asc' ? 'up' : 'down')
                . '"></span>';
        }

        //dddx(['sort_by' => $sort_by, 'order' => $order]);

        /*
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
        */
        $url = request()->fullUrlWithQuery([
            'sort' => $sort,
        ]);

        $this->url = $url;
        $this->label = $name;
        $this->icon = $icon;
    }

    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view =  app(GetViewAction::class)->execute($this->tpl);

        $view_params = [];

        return view($view, $view_params);
    }
}
