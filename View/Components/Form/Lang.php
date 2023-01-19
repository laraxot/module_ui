<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Form;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Cms\Services\PanelService;

class Lang extends Component
{
    public string $type;
    public string $current_locale;
    public array $supported_locale;

    public array $attrs = [];

    public bool $show;

    public function __construct(string $type = 'v1')
    {
        $this->type = $type;
        $this->current_locale = LaravelLocalization::getCurrentLocaleName();
        $this->supported_locale = LaravelLocalization::getSupportedLocales();
        $panel = PanelService::make()->getRequestPanel();
        if (! is_null($panel)) {
            $this->show = $panel->hasLang();
        } else {
            throw new \Exception('['.__LINE__.']['.__FILE__.'], panel is null');
        }
    }

    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.form.lang.'.$this->type;

        $view_params = [];

        return view()->make($view, $view_params);
    }

    public function shouldRender(): bool
    {
        return $this->show;
    }
}
