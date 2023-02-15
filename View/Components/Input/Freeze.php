<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Input;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Spatie\ModelStates\State;
use Illuminate\View\Component;
use Modules\UI\Datas\FieldData;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Renderable;

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
<<<<<<< HEAD
            $this->value = Arr::get($tmp, $field->getNameDot())??$row->{$field->name};
        } else {
            try{
            $this->value = $row->{$field->name} ?? Arr::get($tmp, $field->getNameDot());
        }catch(Exception $e){
            dddx(['field'=>$this->field,'row'=>$this->row,'exception'=>$e]);
        }
=======
            $this->value = Arr::get($tmp, $field->getNameDot()) ?? $row->{$field->name};
        } else {
            try {
                $this->value = $row->{$field->name} ?? Arr::get($tmp, $field->getNameDot());
            } catch (\Exception $e) {
                dddx(['field' => $this->field, 'row' => $this->row, 'exception' => $e]);
            }
>>>>>>> 8e967e0812a54c55c21b148322371762d3f677f9
        }

        if (is_countable($field->options) && count($field->options) > 0) {
            // if (null !== $this->value &&  !is_array($this->value)) {
            // if (null !== $this->value && ctype_alnum($this->value)) {
            if (null !== $this->value && (is_string($this->value) || is_numeric($this->value))) {
                $this->value = collect($field->options)->get((string) $this->value) ?? $this->value;
            } else {
                $this->value = '';
            }
        }
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): Renderable {
        $value_type = gettype($this->value);
        if ('object' == $value_type) {
            if ($this->value instanceof Model) {
                $value_type = 'Model';
            } elseif ($this->value instanceof State) {
                $value_type = 'State';
            } elseif (is_object($this->value) || is_string($this->value)) {
                $value_type = class_basename($this->value);
            }/*else {

            }
            */
        }
        // if ('Collection' == $value_type) {
        if ($this->value instanceof Collection) {
            $first = $this->value->first();
            if ($first instanceof Model) {
                $value_type .= '.Model';
            }
        }

        // if ('string' == $value_type && Str::contains($this->value, '.')) {
        if (is_string($this->value) && Str::contains($this->value, '.')) {
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
        /*
        if (! in_array($value_type, ['integer', 'string'])) {
            dddx([
                'value' => $this->value,
                'field' => $this->field,
                'row' => $this->row,
                'value_type' => $value_type,
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
        if (! view()->exists($view)) {
            throw new \Exception('view ['.$view.'] not found');
        }

        return view($view, $view_params);
    }
}
