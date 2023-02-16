<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class Badge extends Component {
    public string $tpl;

    public array $attrs = [];

    public function __construct(string $tpl = 'v1') {
        $this->tpl = $tpl;
        $this->attrs['class'] = 'badge badge-primary';
        if (inAdmin()) {
            $class = config('adm_theme::styles.badge');
        } else {
            $class = config('pub_theme::styles.badge');
        }
        if (! is_null($class)) {
            $this->attrs['class'] = config('pub_theme::styles.badge');
        }
    }

    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.badge.'.$this->tpl;

        $view_params = [];

        return view()->make($view, $view_params);
    }
}
