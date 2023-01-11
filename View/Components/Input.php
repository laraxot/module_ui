<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

/**
 * Undocumented class.
 */
class Input extends Component {
    public array $attrs = [];
    public string $type = 'text';
    public string $name = 'empty-name';
    public ?array $options = [];

    /**
     * ---.
     */
    public function __construct(string $name, string $type, ?array $options = []) {
        $this->name = $name;
        $this->type = Str::snake($type);
        $this->options = $options;
        $this->attrs['name'] = $this->name;
        $this->attrs['class'] = 'form-control';
        $this->attrs['wire:model.lazy'] = 'form_data.'.$name;

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
        $view = 'ui::components.input.'.$this->type.'.field';

        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
