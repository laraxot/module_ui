<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Input;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

/**
 * Class Rows.
 */
class Rows extends Component
{
    public string $type;
    public string $name;
    public ?string $label;
    public Collection $rows;
    public ?Collection $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $type, string $name, Collection $rows, ?string $label = null, ?Collection $value = null)
    {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->rows = $rows;
        $this->value = $value;
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable
    {
        $view = 'ui::components.input.rows.'.$this->type;
        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }
}
