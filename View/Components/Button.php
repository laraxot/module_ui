<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class Button extends Component
{
    public string $tpl;
    public string $type;

    public array $attrs;
    public ?string $url = '#';

    /**
     * Create the component instance.
     *
     * @return void
     */
    public function __construct(string $tpl = 'v1', string $type = 'button', array $attrs = [])
    {
        // dddx($attrs);
        $this->tpl = $tpl;
        $this->type = $type;
        $this->attrs = $attrs;

        $this->url = isset($attrs['url']) ? $attrs['url'] : null;

        $class_key = inAdmin() ? 'adm_theme::styles.button.'.$type : 'pub_theme::styles.button.'.$type;
        $this->attrs['class'] = config($class_key, 'btn btn-primary mb-2');

        // dddx([$class_key, $this->attrs['class']]);
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.button.'.$this->tpl;

        $view_params = ['view' => $view];

        return view()->make($view, $view_params);
    }
}
