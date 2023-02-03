<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Input;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Modules\Cms\Services\PanelService;
use Modules\UI\Datas\FieldData;

/**
 * WIP WIP WIP.
 */
class Field extends Component {
    public FieldData $field;
    public ?Model $row = null;
    public string $tpl;
    public array $attrs = [];
    /**
     * @var mixed
     */
    public $value = null;

    /**
     * Undocumented function.
     */
    public function __construct(FieldData $field, ?Model $row = null, string $tpl = 'v1') {
        $this->tpl = $tpl;
        $this->field = $field;
        $this->row = $row;
        if (null != $row) {
            $tmp = $row->toArray();

            if (Str::contains($field->getNameDot(), '.')) {
                $this->value = Arr::get($tmp, $field->getNameDot());
            } else {
                $this->value = $row->{$field->name} ?? Arr::get($tmp, $field->getNameDot());
            }
        }

        if (is_iterable($field->options) && count($field->options) > 0) {
            $this->value = collect($field->options)->get($this->value) ?? $this->value;
        }

        /*
        $this->attrs['class'] = 'form-label';

        $panel = PanelService::make()->getRequestPanel();
        $this->tradKey = 'pub_theme::txt';
        if (null !== $panel) {
            $this->tradKey = $panel->getTradMod();
        }
        */
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): Renderable {
        /*
        $this->attrs['class'] = 'form-control';
        $this->attrs['name'] = $field->name;
        $type = $this->field->type;
        */
        $field = $this->field;
        $div_attrs = app(ComponentAttributeBag::class);
        $label_attrs = app(ComponentAttributeBag::class);
        $input_attrs = app(ComponentAttributeBag::class);

        $label_attrs = $label_attrs->merge(
            [
                'name' => $field->name,
                'label' => $field->label ?? $field->name,
                // 'class' => $field->label_class,
            ]
        );

        $div_class = 'form-group col-'.$this->field->col_size;

        $div_attrs = $div_attrs->merge(
            [
                'class' => $div_class,
            ]
        );

        // dddx($input_attrs->merge($this->field->toArray()));
        // altrimenti dà errore sui campi come gender
        $input_attrs = $input_attrs->merge($this->field->except('options')->toArray());

        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.input.field.'.$this->tpl;
        // $view = 'ui::components.input.freeze.'.$value_type.'.'.$this->tpl;
        // dddx(['view' => $view, 'field' => $this->field]);
        $view_params = [
            'name' => $this->field->name,
            'view' => $view,
            'div_attrs' => $div_attrs,
            'label_attrs' => $label_attrs,
            'input_attrs' => $input_attrs,
        ];

        return view($view, $view_params);
    }
}
