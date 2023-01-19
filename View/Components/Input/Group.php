<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Input;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;

/**
 * Undocumented class.
 */
class Group extends Component
{
    public string $tpl = 'group';
    // public string $name;
    // public string $type;
    public array $data = [];
    public array $options = [];

    /*
    public function __construct(string $name, string $type, ?array $options = null) {
        $this->name = $name;
        $this->type = $type;
        $this->options = $options ?? [];
    }
    */
    public function __construct(?array $options = null)
    {
        // $this->name = $name;
        // $this->type = $type;
        $this->options = $options ?? [];
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render()
    {
        return function (array &$data) {
            return $this->renderData($data);
        };
    }

    /**
     * @see https:// stackoverflow.com/questions/65334221/laravel-accessing-attributes-slots-within-component-classes
     */
    public function renderData(array &$data): string
    {
        extract($data);
        if (! isset($attributes)) {
            throw new \Exception('['.__LINE__.']['.__FILE__.']');
        }

        // attributes type è il tipo di input (es. select)
        // dddx(get_defined_vars());
        if (null != $attributes->get('tpl')) {
            $this->tpl = $attributes->get('tpl');
        }

        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.input.group.'.$this->tpl;

        $div_attrs = app(ComponentAttributeBag::class);
        $label_attrs = app(ComponentAttributeBag::class);
        $id = $attributes->get('id') ?? Str::slug($attributes->get('name'));

        $label_attrs = $label_attrs->merge(
            [
                'id' => $id,
                'name' => $attributes->get('name'),
                'label' => $attributes->get('label'),
                'class' => $attributes->get('label_class'),
            ]
        );

        $input_attrs = $attributes;
        $tmp = [];
        foreach ($input_attrs->getAttributes() as $k => $v) {
            if (is_array($v)) {
                $v = json_encode($v);
            }
            $tmp[$k] = $v;
        }
        $input_attrs->setAttributes($tmp);
        $col_size = $attributes->get('col_size') ?? '12';
        $div_class = 'form-group '.$attributes->get('div_class').' col-'.$col_size;
        if ('checkbox' == $attributes->get('type')) {
            $div_class = 'form-check';
        }

        $div_attrs = $div_attrs->merge(
            [
                'class' => $div_class,
            ]
        );

        $view_params = [
            // 'view' => $view,
            'div_attrs' => $div_attrs,
            'label_attrs' => $label_attrs,
            'input_attrs' => $input_attrs,
        ];
        $view_params = array_merge($data, $view_params);
        // return View::make($view, $view_params);
        // $data['attributes']['div_attrs'] = $div_attrs;
        // $data['div_attrs'] = $div_attrs;

        return view($view, $view_params)->render();
    }

    public function shouldRender(): bool
    {
        return true;
    }
}
