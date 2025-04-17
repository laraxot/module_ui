<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;
use Modules\UI\Services\ThemeService;

/**
 * Undocumented class.
 */
class IncludeView extends Component {
    public string $view;
    public array $vars = [];

    public function __construct(string $view, array $vars = []) {
        $this->view = $view;
        $this->vars = $vars;
    }

    public function render(): Renderable {
        $views = ThemeService::getDefaultViewArray();

        $view_tpl = $this->view;

        $views = collect($views)->map(
            function ($item) use ($view_tpl) {
                return $item.'.'.$view_tpl;
            }
        );

        /**
         * @phpstan-var view-string|null
         */
        $view_work = $views->first(
            function ($view_check) {
                return View::exists($view_check);
            }
        );

        if (null === $view_work) {
            if (\in_array($view_tpl, ['topbar', 'bottombar', 'inner_page'], true)) {
                /**
                 * @phpstan-var view-string
                 */
                $view = 'ui:empty';

                return view($view);
                // throw new \Exception('$view_work is null');
            }

            dddx(['err' => 'view not Exists', 'views' => $views]);
        }

        if (null === $view_work) {
            throw new \Exception('$view_work is null');
        }

        return view($view_work, $this->vars);
    }
}
