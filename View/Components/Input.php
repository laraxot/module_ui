<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;
use Modules\Cms\Services\PanelService;
use Modules\UI\Actions\GetCollectiveViewByType;

/**
 * Undocumented class.
 */
class Input extends Component {
    public array $attrs = [];
    public string $type = 'text';
    public string $name = 'empty-name';
    // public string $name_dot = 'empty.name';
    public ?array $options = [];
    // public string $tpl;
    public string $collective_view;
    public string $tradKey;

    /**
     * ---.
     */
    public function __construct(string $name, string $type, ?array $options = [], ?array $attributes = []) {
        $this->name = $name;
        $this->collective_view = app(GetCollectiveViewByType::class)->execute($type); // ui::collective.fields.string.field

        $this->tradKey = 'pub_theme::txt';
        if (class_exists(PanelService::class)) {
            $panel = PanelService::make()->getRequestPanel();
            if (null !== $panel) {
                $this->tradKey = $panel->getTradMod();
            }
        }

        $this->type = $type;

        $this->options = $options;
        $name_dot = dottedToBrackets($this->name);
        $this->attrs['name'] = $name_dot;
        $this->attrs['class'] = 'form-control';
        $this->attrs['wire:model.lazy'] = 'form_data.'.$name;
        $trans_key = $this->tradKey.'.'.$name_dot.'.placeholder';
        $trans = trans($trans_key);
        $this->attrs['placeholder'] = ($trans != $trans_key) ? $trans : $name_dot;

        if (is_array($attributes) && count($attributes) > 0) {
            $this->attrs = array_merge($this->attrs, $attributes);
        }

        switch ($this->type) {
            case 'checkbox.arr':
                $this->attrs['class'] = 'form-check-input';
                break;
            case 'checkbox':
                $this->attrs['class'] = 'form-check-input';
                break;
            case 'radio':
                $this->attrs['class'] = '';
                break;
            case 'radio.arr':
                $this->attrs['class'] = 'form-check-input';
                break;
            case 'select.multiple':
                $this->attrs['class'] = 'selectpicker form-control';
                $this->attrs['multiple'] = 'multiple';
                $this->attrs['data-style'] = 'btn-selectpicker';

                $this->attrs['data-selected-text-format'] = 'count &gt; 1';
                $this->attrs['data-none-selected-text'] = '';
                break;
        }
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): Renderable {
        // esempio Modules/UI/Resources/views/components/input/select/field.blade.php
        /**
         * @phpstan-var view-string
         */
        // $view = app(GetViewAction::class)->execute($this->type.'.field');
        // collective = ui::collective.fields.string.field
        $view = str_replace('ui::collective.fields.', 'ui::components.input.', $this->collective_view);

        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
