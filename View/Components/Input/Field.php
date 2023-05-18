<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Input;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Modules\Cms\Actions\GetViewAction;
use Modules\UI\Datas\FieldData;

class Field extends Component
{
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
    public function __construct(FieldData $field, ?Model $row = null, string $tpl = 'v1')
    {
        $this->tpl = $tpl;
        $this->field = $field;
        $this->row = $row;

        // $this->value = $this->field->value ?? null;
        if (null != $row) {
            if (Str::contains($field->getNameDot(), '.')) {
                $this->value = Arr::get($row, $field->getNameDot());
            } else {
                $this->value = $row->{$field->name} ?? Arr::get($row, $field->getNameDot());
            }
        }
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): Renderable
    {
        $field = $this->field;
        $div_attrs = app(ComponentAttributeBag::class);
        $label_attrs = app(ComponentAttributeBag::class);
        $input_attrs = app(ComponentAttributeBag::class);

        $label_attrs = $label_attrs->merge(
            [
                'name' => $field->name,
                'label' => $field->label ?? $field->name,
            ]
        );

        $div_class = 'form-group col-'.$this->field->col_size;

        $div_attrs = $div_attrs->merge(
            [
                'class' => $div_class,
            ]
        );

        // altrimenti dà errore sui campi come gender
        $input_attrs = $input_attrs
            ->merge(
                collect($this->field)
                    ->except(['options', 'attributes', 'rules'])
                    ->map(
                        function ($item, $key) {
                            if (is_array($item)) {
                                return json_encode($item);
                            }

                            return $item;
                        }
                    )
                    ->toArray()
            );

        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);

        $view_params = [
            'name' => $this->field->name,
            'view' => $view, // ui::components.input.field.v1
            'div_attrs' => $div_attrs,
            'label_attrs' => $label_attrs,
            'input_attrs' => $input_attrs,
        ];

        return view($view, $view_params);
    }
}
