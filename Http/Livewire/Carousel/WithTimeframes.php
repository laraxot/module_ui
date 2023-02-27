<?php

declare(strict_types=1);

namespace Modules\UI\Http\Livewire\Carousel;

use Livewire\Component;
use Modules\Cms\Actions\GetViewAction;
use Illuminate\Contracts\Support\Renderable;
use Modules\Mediamonitor\Actions\PositionToStrposAction;


/**
 * Undocumented class.
 */
class WithTimeframes extends Component
{
    public int $press_id;
    public string $tpl;
    public array $items;
    public int $i = 0;
    public ?bool $showBtnLink;
    public string $component_id;
    public string $txt;

    /**
     * Undocumented function.
     */
    public function mount(string $component_id, array $items, ?bool $showBtnLink = true, string $tpl = 'v1', string $txt): void
    {
        $this->items = $items;
        $this->showBtnLink = $showBtnLink;
        $this->tpl = $tpl;
        $this->component_id = $component_id;
        $this->txt = $txt;
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        // $view = 'ui::livewire.carousel.carousel.'.$this->tpl;
        $view = app(GetViewAction::class)->execute($this->tpl);

        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }

    public function next(): void
    {
        ++$this->i;
        $str = (string) $this->items[$this->i];
        // dddx([
        //     $str,
        //     $this->txt,
        // ]);
        $strpos = app(PositionToStrposAction::class)->execute($str, $this->txt);

        $this->emit('getFrameSecond', $this->component_id,$this->i);
    }

    public function prev(): void
    {
        --$this->i;
        $this->emit('getFrameSecond', $this->component_id,$this->i);
    }
}
