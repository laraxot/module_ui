<?php

declare(strict_types=1);

namespace Modules\UI\Http\Livewire\Input;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

/**
 * Class Slider.
 */
class Slider extends Component
{
    public string $driver = 'noui';
    public array $attrs = [];
    public float $min = 0;
    public float $max = 100;
    public array $values = [0, 100];

    /**
     * Undocumented variable.
     *
     * @var array
     */
    protected $listeners = [
        'setSliderMinMax' => 'setMinMax',
        'setSliderValues' => 'setValues',
        'test' => 'test',
    ];

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function mount(string $id, ?string $driver = null)
    {
        if (null !== $driver) {
            $this->driver = $driver;
        }
        $this->attrs['id'] = $id;
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = 'ui::livewire.input.slider.'.$this->driver;
        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }

    /**
     * Set min - max of slider.
     */
    public function setMinMax(float $min, float $max): void
    {
        $this->min = $min;
        $this->max = $max;
        $this->dispatchBrowserEvent('setSliderMinMax', ['min' => $min, 'max' => $max]);
    }

    /**
     * set values of range.
     */
    public function setValues(array $values): void
    {
        $this->values = $values;
        $this->dispatchBrowserEvent('setSliderValues', ['values' => $values]);
    }

    public function updateValues(array $values): void
    {
        $this->values = $values;
        $this->emit('updateSliderValues', $values);
        $this->emit('updateSliderValues', $values);
    }

    // * 4 debug
    public function test(): void
    {
        dddx($this->values);
    }

    // */
}
