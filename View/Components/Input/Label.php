<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Input;

use Illuminate\View\Component;
use Modules\Cms\Actions\GetStyleClassByViewAction;
use Modules\Cms\Actions\GetViewAction;
use Modules\Cms\Services\PanelService;

/**
 * Undocumented class.
 */
class Label extends Component {
    public array $attrs = [];
    public string $tpl;
    public string $tradKey;

    /**
     * Undocumented function.
     */
    public function __construct(string $tpl = 'v1') {
        $this->tpl = $tpl;
        /*
        $this->attrs['name'] = $this->name;

        $this->for = 'form_data.'.$this->name;
        */
        // $this->attrs['class'] = 'form-label';

        $this->tradKey = 'pub_theme::txt';
        if (class_exists(PanelService::class)) {
            $panel = PanelService::make()->getRequestPanel();
            if (null !== $panel) {
                $this->tradKey = $panel->getTradMod();
            }
        }
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render() {
        // *
        return function (array &$data) {
            return $this->renderData($data);
        };
        // */

        // $view = app(GetViewAction::class)->execute($this->tpl);
        /*
         * @phpstan-var view-string
         */
        // $view = app(GetViewAction::class)->execute($this->tpl);

        // $this->attrs['class'] = app(GetStyleClassByViewAction::class)->execute($view);

        // $view_params = [
        //     'view' => $view,
        // ];

        // return view($view, $view_params);
    }

    public function renderData(array $data): string {
        extract($data);
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);
        $this->attrs['class'] = app(GetStyleClassByViewAction::class)->execute($view);

        if (isset($attributes) && is_object($attributes)) {
            $label = $attributes->get('label');
            $name = $attributes->get('name');
            $this->attrs['for'] = $attributes->get('id');
        }

        if (isset($name) && !isset($label)) {
            $trans_key = $this->tradKey.'.'.$name.'.label';
            $label = trans($trans_key);
            // if ($trans_key == $name_lang) {
            //     $name_lang = $name;

            //     $label = $label ?? $name_lang;
            // }else{
            //     $label = $name_lang;
            // }
        }

        $view_params = [
            'view' => $view,
            'label' => $label ?? '',
            'attrs' => $this->attrs,
        ];
        $view_params = array_merge($data, $view_params);

        return view($view, $view_params)->render();
    }
}
