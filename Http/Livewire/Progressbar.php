<?php

declare(strict_types=1);

namespace Modules\UI\Http\Livewire;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Modules\Cms\Actions\GetViewAction;

class Progressbar extends Component {
    public int $perc = 0;
    public string $autostart = 'false';
    public string $autocomplete = 'true';
    public int $loop_index = 0;
    public int $loop_max = 100;
    public array $errors = [];
    public string $title = '';
    public string $message = '';
    public string $url = '?';
    public string $onComplete = '';
    public string $tpl = 'v1';

    /**s
     * --.
     */
    public function start(): void {
        if ($this->loop_index < $this->loop_max) {
            $this->perc = (int) ($this->loop_index * 100 / $this->loop_max);
            $this->handle();
            $this->emit('updateProgress', $this->perc);
        } else {
            $this->perc = 100;
            session()->flash('message', 'FINITO');
            $this->complete();
        }
    }

    public function handle(): void {
        ++$this->loop_index;
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable {
        $view = app(GetViewAction::class)->execute($this->tpl);

        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }

    public function init(): void {
        if ('true' === $this->autostart) {
            $this->start();
        }
    }

    /**
     * Undocumented function.
     *
     * @return mixed
     */
    public function complete() {
        if ('true' === $this->autocomplete && '' != $this->onComplete) {
            return $this->{$this->onComplete}();
        }
    }
}
