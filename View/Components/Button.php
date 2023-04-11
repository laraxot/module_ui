<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;
use Modules\Cms\Services\PanelService;
use Illuminate\Contracts\Support\Renderable;
use Modules\Cms\Actions\GetStyleClassByViewAction;

class Button extends Component {
    public string $tpl;
    public string $type;

    public array $attrs;
    public ?string $url = '#';
    public string $view;

    public string $tradKey;

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
        // dddx($this->attrs['class']);
        $this->attrs['icon'] = isset($attrs['icon']) ? $attrs['icon'] : null;
        // $icon_class = inAdmin() ? 'adm_theme::styles.button.icon.'.$type : 'pub_theme::styles.button.icon.'.$type;
        // $this->attrs['icon'] = config($icon_class, 'fas fa-angle-double-left');

        $this->tradKey = 'pub_theme::txt';
        if (class_exists(PanelService::class)) {
            $panel = PanelService::make()->getRequestPanel();
            if (null !== $panel) {
                $this->tradKey = $panel->getTradMod();
            }
        }
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
