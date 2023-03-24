<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Input;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;
use Modules\UI\Datas\FieldData;
use Spatie\ModelStates\State;

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

        try {
            /*if (! \in_array($field->name, ['profile', 'roles'])) {
                dddx($field->name);
            }*/

            $this->value = $this->row->{$field->name} ?? Arr::get($row, $field->getNameDot());
        } catch (\Exception $e) {
            dddx(['field' => $this->field, 'row' => $this->row, 'exception' => $e]);
            $this->value = null;
        }
        /*
        if (is_countable($field->options) && count($field->options) > 0) {
            // if (null !== $this->value &&  !is_array($this->value)) {
            // if (null !== $this->value && ctype_alnum($this->value)) {
            if (null !== $this->value && (is_string($this->value) || is_numeric($this->value))) {
                $this->value = collect($field->options)->get((string) $this->value) ?? $this->value;
            } else {
                $this->value = '';
            }
        }
        */
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
        if (is_string($this->value) && class_exists($this->value)) {
            // && $this->value instanceof \Spatie\ModelStates\State
            $reflection_class = new \ReflectionClass($this->value);

            // dddx([
            //     'value_type' => $value_type,
            //     'value' => $this->value,
            //     //  'test' => $reflection_class->isInstance(\Spatie\ModelStates\State::class),
            //     // 'rf_parent' => $reflection_class->getParentClass()->getParentClass()->getName(),
            //     'rf_parent' => $reflection_class->getParentClass()->getName(),
            // ]);

            if (false != $reflection_class->getParentClass()->getParentClass()) {
                $str = $reflection_class
                    ->getParentClass()
                    ->getParentClass()
                    ->getName();

                switch ($str) {
                    case 'Spatie\\ModelStates\\State':
                        $value_type = 'state';
                        break;
                    default:
                        throw new \Exception('['.$str.']['.__LINE__.']['.__FILE__.']');
                        break;
                }
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

        if ('Cell' == $this->field->type) {
            $value_type = 'cell';
        }

        $value_type = Str::lower($value_type);
        /*
        if ($this->field->name == 'state') {
            dddx([
                'value_type' => $value_type,
                'value' => $this->value,

            ]);
        }
        //*/
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($value_type.'.'.$this->tpl);

        $view_params = [
            'view' => $view,
        ];
        if (! view()->exists($view)) {
            throw new \Exception('view ['.$view.'] not found');
        }

        return view($view, $view_params);
    }
}
