<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Input;

use Illuminate\View\Component;
use Modules\Xot\Services\FileService;
use Modules\Cms\Actions\GetViewAction;
use Modules\Cms\Services\PanelService;
use Illuminate\Contracts\Support\Renderable;
use Modules\Cms\Actions\GetStyleClassByViewAction;

/**
 * Undocumented class.
 */
class Label extends Component
{
    public array $attrs = [];
    public string $tpl;
    public string $tradKey;

    /**
     * Undocumented function.
     */
    public function __construct(string $tpl = 'label') {
        $this->tpl = $tpl;
        /*
        $this->attrs['name'] = $this->name;

        $this->for = 'form_data.'.$this->name;
        */
        //$this->attrs['class'] = 'form-label';

        
        $this->tradKey = 'pub_theme::txt';
        if(class_exists(PanelService::class)){
            $panel = PanelService::make()->getRequestPanel();
            if (null !== $panel) {
                $this->tradKey = $panel->getTradMod();
            }
    }
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): Renderable
    {
        /*
        return function (array &$data) {
            return $this->renderData($data);
        };
        */
        //$view = 'ui::components.input.label.label';
         /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);

        $this->attrs['class'] = app(GetStyleClassByViewAction::class)->execute($view); 

        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }

    public function renderData(array $data): string
    {
        extract($data);
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.input.label.'.$this->type;

        /*
        $theme = inAdmin() ? 'adm_theme' : 'pub_theme';
        FileService::viewCopy('ui::components.input.label', $theme.'::components.input.label');

        $view = $theme.'::components.input.label';
        if (null === $this->field) {
            $this->field = (object) [
                'name' => $this->name,
                'type' => $this->type,
            ];
        }
        */
        $view_params = [
            'view' => $view,
        ];
        $view_params = array_merge($data, $view_params);

        return view($view, $view_params)->render();
    }
}