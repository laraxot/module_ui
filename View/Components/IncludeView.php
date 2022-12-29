<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Exception;
use Illuminate\View\Component;
use Illuminate\Support\Facades\View;
use Modules\UI\Services\ThemeService;

/**
 * Undocumented class.
 */
class IncludeView extends Component {
    public string $view;

    public function __construct(string $view) {
        $this->view = $view;
    }

    public function render() {
        $views = ThemeService::getDefaultViewArray();

        $view_tpl = $this->view;

        $views = collect($views)->map(
            function ($item) use ($view_tpl) {
                return $item.'.'.$view_tpl;
            }
        );

        // dddx($views);
        $view_work = $views->first(
            function ($view_check) {
                return View::exists($view_check);
            }
        );

        if (null === $view_work) {
            if (\in_array($view_tpl, ['topbar', 'bottombar', 'inner_page'], true)) {
                return null;
                // throw new \Exception('$view_work is null');
            }

            dddx(['err' => 'view not Exists', 'views' => $views]);
        }

        if (null === $view_work) {
            throw new Exception('$view_work is null');
        }

        return view()->make($view_work);
    }
}
