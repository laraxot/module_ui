<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Input;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Modules\Cms\Services\PanelService;
use Modules\UI\Datas\FieldData;

/**
 * Undocumented class.
 */
class Freeze extends Component {
    public FieldData $field;
    public Model $row;
    public string $tpl;
    /**
     * @var mixed
     */
    public $value;

    /**
     * Undocumented function.
     */
    public function __construct(FieldData $field, Model $row, string $tpl = 'v1') {
        $this->tpl = $tpl;
        $this->field = $field;
        $this->row = $row;
        $tmp = $row->toArray();

        if (Str::contains($field->getNameDot(), '.')) {
            $this->value = Arr::get($tmp, $field->getNameDot());
        } else {
            $this->value = $row->{$field->name} ?? Arr::get($tmp, $field->getNameDot());
        }
        $valid_array_offset_type=(is_string($this->value) || is_integer($this->value));
        if (count($field->options) > 0 && $valid_array_offset_type ) {
            /*
            dddx([
                'field'=>$field,
                'value'=>$this->value,
                'row'=>$row,
            ]);
            */
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
        $value_type = gettype($this->value);
        if ('object' == $value_type) {
            $value_type = class_basename($this->value);
        }
        if ('Collection' == $value_type) {
            $first = $this->value->first();
            if ($first instanceof Model) {
                $value_type .= '.Model';
            }
        }

        if ('string' == $value_type && Str::contains($this->value, '.')) {
            $info = pathinfo($this->value);
            $ext = $info['extension'] ?? '';
            if (in_array($ext, ['png', 'jpg'])) {
                $value_type = 'image';
            }
        }

        /*
        if (! in_array($value_type, ['integer', 'string', 'NULL', 'Collection.Model'])) {
            dddx([
                'value_type' => $value_type,
                'value' => $this->value,
                'basename' => class_basename($this->value),
            ]);
        }
        */
        $value_type = Str::lower($value_type);
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.input.freeze.'.$value_type.'.'.$this->tpl;
        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
