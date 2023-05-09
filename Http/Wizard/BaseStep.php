<?php

declare(strict_types=1);

namespace Modules\UI\Http\Wizard;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Str;
use Modules\Cms\Actions\GetViewAction;
use Modules\UI\Datas\FieldData;
use Spatie\LivewireWizard\Components\StepComponent;

abstract class BaseStep extends StepComponent
{
    public array $form_data = [];
    public string $tpl = '';
    public ?string $view = null;

    /**
     * The default rules that the model will validate against.
     *
     * @var array
     */
    protected $rules = [
        // 'form_data.category_id' => 'required',
    ];

    /* --- cosi' non funziona.. da pensare altro metodo ..
    public static function getName(): string
    {
        // return 'wizard.service.steps.choose-category-company';
        $backtrace = debug_backtrace();
        $obj = $backtrace[1]['object'];
        $t1 = new \ReflectionClass($obj);
        $file = $t1->getFileName();

        $tmp = app(GetViewAction::class)->execute('', $file);
        $tmp = str_replace('::livewire.', '::', $tmp);
        $tmp = Str::after($tmp, '::');

        return $tmp;
    }
    */

    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = $this->getView();

        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }

    public function getView(): string
    {
        if (null != $this->view) {
            return $this->view;
        }
        $backtrace = debug_backtrace();

        if (!isset($backtrace[0]['object'])) {
            throw new \Exception('[][]');
        }
        $obj = $backtrace[0]['object'];
        $t1 = new \ReflectionClass($obj);
        $file = $t1->getFileName();
        if (false === $file) {
            throw new \Exception('[][]');
        }

        $this->view = app(GetViewAction::class)->execute($this->tpl, $file);

        return $this->view;
    }

    public function stepInfo(): array
    {
        $trans_key = str_replace('::livewire.', '::', $this->getView());
        return [
            'label' => trans($trans_key . '.label'),
            'icon' => trans($trans_key . '.icon'),
        ];
    }

    public function goNextStep(): void
    {
        $this->validate();
        $this->nextStep();
    }

    public function toData(array $data): FieldData
    {
        return FieldData::from($data);
    }
}
