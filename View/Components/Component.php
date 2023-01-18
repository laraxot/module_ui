<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component as ViewComponent;
use Modules\Xot\Services\FileService;

/**
 * Class Component.
 * controlla l'esistenza dei componenti formx richiamati tramite i field dei pannelli
 * se esiste quello del tema, nel caso utilizza quello di default.
 */
class Component extends ViewComponent
{
    public string $type;

    public string $table_class = 'table table-striped table-hover table-bordered table-condensed';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $type)
    {
        $this->type = $type;
        $table_class = FileService::config('adm_theme::styles.table.class');
        if (! \is_string($table_class)) {
            $table_class = 'table';
        }
        if (null !== $table_class) {
            $this->table_class = $table_class;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Renderable
    {
        $views = [
            'adm_theme::components.'.$this->type,
            'ui::components.'.$this->type,
        ];

        $view = Arr::first(
            $views,
            function ($item) {
                // Call to an undefined method Illuminate\Contracts\View\Factory|Illuminate\Contracts\View\View::exists()
                return view()->exists($item);
            }
        );
        if (null === $view) {
            throw new \Exception('not exists '.$views[0].' or '.$views[1]);
        }
        $view_params = [];
        if (! \is_string($view)) {
            throw new \Exception('['.__LINE__.']['.__FILE__.']');
        }
        // return view()->make($view);
        return View::make($view, $view_params);
    }
}
