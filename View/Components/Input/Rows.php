<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Input;

use Illuminate\View\Component;
use Illuminate\Support\Collection;
use Modules\Cms\Actions\GetViewAction;
use Illuminate\Contracts\Support\Renderable;

/**
 * Class Rows.
 */
class Rows extends Component {
    public string $tpl;
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
    public function __construct(string $type, string $name, Collection $rows, ?string $label = null, ?Collection $value = null,string $tpl = 'v1') {
        $this->tpl = $tpl;
        $this->name = $name;
        $this->label = $label;
        $this->rows = $rows;
        $this->value = $value;
        $this->type = $type;
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable {
        /*
         * @phpstan-var view-string
         */
        // $view = 'ui::components.input.rows.'.$this->type;
        // $view = app(GetViewAction::class)->execute($value_type.'.'.$this->tpl);
        $view = app(GetViewAction::class)->execute($this->type.'.'.$this->tpl);
        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
