<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class Button extends Component
{
    public string $type;

    public array $attrs;

    /**
     * Create the component instance.
     *
     * @return void
     */
    public function __construct(string $type = 'v1', array $attrs = [])
    {
        $this->type = $type;
        $this->attrs = $attrs;

        if (inAdmin()) {
            $this->attrs['class']['button'] = config('adm_theme::styles.edit.button.class', 'btn btn-primary mb-2');
        } else {
            $this->attrs['class']['button'] = config('pub_theme::styles.edit.button.class', 'btn btn-primary mb-2');
        }
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.button.'.$this->type;

        $view_params = ['view' => $view];

        return view()->make($view, $view_params);
    }
}
