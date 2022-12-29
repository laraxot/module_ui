<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Renderable;

/**
 * Class Section.
 */
class Section extends Component {
    public array $attrs = [];
    public string $type;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $type='trending') {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Renderable {

        /**
         * @phpstan-var view-string
         */
        $view='ui::components.section.'.$this->type;
        $view_params=[
            'view'=>$view,
        ];
        return view($view,$view_params);
    }
}
