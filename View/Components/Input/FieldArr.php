<?php

declare(strict_types=1);

namespace Modules\UI\View\Components\Input;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;
use Modules\ExtraField\Datas\FieldData;

/**
 * WIP WIP WIP.
 */
class FieldArr extends Component
{
    public FieldData $field;
    public ?Model $row = null;
    public string $tpl;
    /**
     * @var mixed
     */
    public $value = null;

    /**
     * Undocumented function.
     */
    public function __construct(array $field, ?Model $row = null, string $tpl = 'v1')
    {
        $this->field = FieldData::from($field);
        $this->row = $row;
        $this->tpl = $tpl;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);
        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
