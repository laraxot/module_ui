<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Input;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\Cms\Services\PanelService;
use Modules\Xot\Services\FileService;

/**
 * Undocumented class.
 */
class Label extends Component
{
    public array $attrs = [];
    public ?string $type;
    public string $tradKey;

    /**
     * Undocumented function.
     */
    public function __construct(?string $type = 'label')
    {
        $this->type = $type;
        /*
        $this->attrs['name'] = $this->name;

        $this->for = 'form_data.'.$this->name;
        */
        $this->attrs['class'] = 'form-label';

        $panel = PanelService::make()->getRequestPanel();
        $this->tradKey = 'pub_theme::txt';
        if (null !== $panel) {
            $this->tradKey = $panel->getTradMod();
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
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.input.label.label';
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
