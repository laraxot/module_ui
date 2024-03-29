<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Table\Th;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;

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
        /**
         * @var string $sort_request
         */
        $sort_request = request('sort', '');
        $sort = strval($sort_request);
        $sort_by = $sort;
        $order = 'asc';
        if (Str::startsWith($sort_by, '-')) {
            $sort_by = Str::after($sort_by, '-');
            $order = 'desc';
            $sort = $name;
        } else {
            $sort = '-'.$name;
        }
        if ($sort_by == $name) {
            $icon = ' <span class="fa fa-caret-'
                .('asc' == $order ? 'up' : 'down')
                .'"></span>';
        }

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
        $view = app(GetViewAction::class)->execute($this->tpl);

        $view_params = [];

        return view($view, $view_params);
    }
}
