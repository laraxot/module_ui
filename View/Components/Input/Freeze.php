<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Input;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
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
        $this->value = Arr::get($tmp, $field->getNameDot());

        /*
        if ('areas' == $field->name) {
            dddx(
                [
                    'field' => $field,
                    'name_dot' => $field->getNameDot(),
                    'row' => $row,
                    'row_val' => $row->{$field->name},
                    'value' => $this->value,
                    'getType' => gettype($this->value),
                    'tmp' => $tmp,
                ]
            );
        }
        // */
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
