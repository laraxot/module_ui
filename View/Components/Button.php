<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetStyleClassByViewAction;
use Modules\Cms\Actions\GetViewAction;

class Button extends Component {
    public string $tpl;
    public string $type;

    public array $attrs;
    public ?string $url = '#';
    public string $view;

    /**
     * Create the component instance.
     *
     * @return void
     */
    public function __construct(string $tpl = 'v1', string $type = 'button', array $attrs = []) {
        // dddx($attrs);
        $this->tpl = $tpl;
        $this->type = $type;
        $this->attrs = $attrs;

        $this->url = isset($attrs['url']) ? $attrs['url'] : null;

        $this->view = app(GetViewAction::class)->execute($this->tpl);
        $this->attrs['class'] = app(GetStyleClassByViewAction::class)->execute($this->view);
        $this->attrs['type'] = $type;
        // dddx([$class_key, $this->attrs['class']]);
        $this->attrs['icon'] = isset($attrs['icon']) ? $attrs['icon'] : null;
        // $icon_class = inAdmin() ? 'adm_theme::styles.button.icon.'.$type : 'pub_theme::styles.button.icon.'.$type;
        // $this->attrs['icon'] = config($icon_class, 'fas fa-angle-double-left');
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = $this->view;

        $view_params = ['view' => $view];

        return view($view, $view_params);
    }
}
